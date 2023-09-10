#include <stdio.h>
#include <stdlib.h>
#include <stdbool.h>
#include <string.h>
#include <ctype.h>
#include <math.h>
#include <time.h>
#include<omp.h>
        
#define MAXCHAR 1000
#define MAX_FP 0.05
#define NUM_THREAD 8

void putRowsInArray(char *fileName, char ** list, int startIndex, int endIndex);

int getNumberOfRows(char *fileName);

void insert(char* bitArray, int size, char* s);

bool lookUp(char* bitArray, int size, char* s);

/**
 * Function to set the bit of the bit array using index 
 * OR bit operation is used to set the bit as 1
*/
void setBit(char *array, int index) {
    #pragma omp atomic
    array[index / 8] |= 1 << (index % 8);
}
 
/**
 * Function to check the bit of the bit array using index
*/
char checkBit(char *array, int index) {
    return 1 & (array[index / 8] >> (index % 8));
}

/**
 * Function to calculate the size to be allocated to bit array
*/
int calculateSize (int x){
    return (x/8+(!!(x%8)))*sizeof(char);
}

int main(){
    omp_set_num_threads(NUM_THREAD);
    double time_taken;      // To save the time taken for one section of code
    int numOfWords = 0;     // To store number of words in word file
    char* bitArray;         // Bit array for bloom filter
    char* wordFile[4] = {"word1.csv", "word2.csv", "word3.csv", "word4.csv"};       // 4 different word files
    int wordFileLength[4] = {0,0,0,0};  // Store length of each word file
    int wordStartIndex[4];          // Store starting index for each file in the word array
    char* queryFile[4] = {"query1.csv","query2.csv", "query3.csv", "query4.csv"};   // 4 different query files
    int queryLength[4] = {0,0,0,0};     // Store length of each query file
    int queryStartIndex[4];             // Store starting index for each file in the query array
    struct timespec start, end, start_1, end_1;     // To record starting and ending time of sections
    int numOfQueries = 0;

    clock_gettime(CLOCK_MONOTONIC, &start); 
    clock_gettime(CLOCK_MONOTONIC, &start_1); 

    /**
     * Read word and query files parallely, each thread reads one file
     * Record the length of each file in an array
    */
    #pragma omp parallel for reduction(+:numOfWords) reduction(+:numOfQueries) shared(wordFile,wordFileLength,queryFile,queryLength) schedule(dynamic)
    for(int i = 0;i<8;i++){
        if(i<4){ // reading of word file
            wordFileLength[i] = getNumberOfRows(wordFile[i]);
            numOfWords += wordFileLength[i];
        }else{ // reading of query file
            queryLength[i%4] = getNumberOfRows(queryFile[i%4]);
            numOfQueries += queryLength[i%4];
        }
    }
    
    clock_gettime(CLOCK_MONOTONIC, &end_1); 
    time_taken = (end_1.tv_sec - start_1.tv_sec) * 1e9; 
    time_taken = (time_taken + (end_1.tv_nsec - start_1.tv_nsec)) * 1e-9; 
	printf("Time taken to count total number of words and queries: %lf\n", time_taken); // ts


    clock_gettime(CLOCK_MONOTONIC, &start_1); 
    
    // record the array location that is assigned to each file
    wordStartIndex[0] = 0;
    queryStartIndex[0] = 0;
    for(int i =1;i<4;i++){
        wordStartIndex[i] = wordStartIndex[i-1]+wordFileLength[i-1];
    }
    for(int i =1;i<4;i++){
        queryStartIndex[i] = queryStartIndex[i-1]+queryLength[i-1];
    }

    // calculate the size of bit array and allocate memory for bit array
    int sizeOfBitArray = (-1)*(numOfWords-1)*log(MAX_FP)/pow(log(2),2);
    bitArray = malloc(calculateSize(sizeOfBitArray));
    
    clock_gettime(CLOCK_MONOTONIC, &end_1); 
    time_taken = (end_1.tv_sec - start_1.tv_sec) * 1e9; 
    time_taken = (time_taken + (end_1.tv_nsec - start_1.tv_nsec)) * 1e-9; 
	printf("Time taken to allocate memory for bit array and non parallelizebale section: %lf\n", time_taken); // ts


    clock_gettime(CLOCK_MONOTONIC, &start_1); 

    // Save all the data into array
    char ** wordList = (char **)malloc(numOfWords*sizeof(char*));
    char ** queryList = (char **)malloc(numOfQueries*sizeof(char*));
    
    // Read and save all the values in word and query file into array in parallel
    // Each thread reads one file
    #pragma omp parallel for shared(wordList,wordFile,wordStartIndex,wordFileLength) schedule(dynamic)
    for(int i = 0;i<8;i++){
        if(i<4){
            putRowsInArray(wordFile[i],wordList,wordStartIndex[i],wordStartIndex[i]+wordFileLength[i]);
        }else{
            putRowsInArray(queryFile[i%4],queryList,queryStartIndex[i%4],queryStartIndex[i%4]+queryLength[i%4]);
        }
    }
    
    clock_gettime(CLOCK_MONOTONIC, &end_1); 
    time_taken = (end_1.tv_sec - start_1.tv_sec) * 1e9; 
    time_taken = (time_taken + (end_1.tv_nsec - start_1.tv_nsec)) * 1e-9; 
	printf("Time taken to save all the words and queries into array: %lf\n", time_taken); // ts


    clock_gettime(CLOCK_MONOTONIC, &start_1); 
    // insert all the values into bit array
    // Each thread is insert a chunk of words in parallel
    char * tok = NULL; // token to to be uses as pointer for tokenizing the string
    #pragma omp parallel for shared(wordList, bitArray) private(tok) schedule(static)
    for(int i = 0;i<numOfWords;i++){
        insert(bitArray, sizeOfBitArray, strtok_r(wordList[i],"\r",&tok));
    }
    
    clock_gettime(CLOCK_MONOTONIC, &end_1); 
    time_taken = (end_1.tv_sec - start_1.tv_sec) * 1e9; 
    time_taken = (time_taken + (end_1.tv_nsec - start_1.tv_nsec)) * 1e-9; 
	printf("Time taken to insert all the words into bit array: %lf\n", time_taken); // ts

    clock_gettime(CLOCK_MONOTONIC, &start_1); 

    // Match the query values with the bitarray
    // Each thread is checks a chunk of words in parallel
    int truePositiveCount = 0;
    int falsePositiveCount = 0;
    bool matched;
    tok = NULL;
    #pragma omp parallel for private(matched,tok) reduction(+:truePositiveCount) reduction(+:falsePositiveCount) shared (bitArray,queryList) schedule(static)
    for(int i = 0;i<numOfQueries;i++){
        matched = lookUp(bitArray, sizeOfBitArray, strdup(strtok_r(queryList[i],", ", &tok)));
        if(matched && (char)tok[0]=='1'){
            truePositiveCount+=1;
        }else if (matched && (char)tok[0] == '0'){
            falsePositiveCount+=1;
        }
    }


    clock_gettime(CLOCK_MONOTONIC, &end_1); 
    time_taken = (end_1.tv_sec - start_1.tv_sec) * 1e9; 
    time_taken = (time_taken + (end_1.tv_nsec - start_1.tv_nsec)) * 1e-9; 
	printf("Time taken to test all the queries: %lf\n", time_taken); // ts


    clock_gettime(CLOCK_MONOTONIC, &end); 
    time_taken = (end.tv_sec - start.tv_sec) * 1e9; 
    time_taken = (time_taken + (end.tv_nsec - start.tv_nsec)) * 1e-9; 
	printf("Overall time(s): %lf\n", time_taken); 


    double accuracy = (double)(truePositiveCount+(numOfWords-falsePositiveCount))/numOfQueries;

    printf("Number of rows in input: %d\n",numOfWords);
    printf("Number of rows in query: %d\n",numOfQueries);
    printf("True Positive Count: %d\n",truePositiveCount);
    printf("False Positive Count: %d\n",falsePositiveCount);
    printf("Accuracy: %lf\n",accuracy);

    for(int i = 0; i<numOfQueries;i++){
        free(queryList[i]);
    }

    for(int i = 0; i<numOfWords;i++){
        free(wordList[i]);
    }
    free(bitArray);

    return 0;
}

/**
 * A list of hash functuions for bloom filter
*/
int hash1(char* value,int size){
    int hash = 3;
    for(int i =0;value[i]!='\0';i++){
        hash = (31*hash+abs(value[i]))%size;
    }
    return abs(hash)%size;
}
int hash2(char* value,int size){
    int hash = 17;
    for(int i =0;value[i]!='\0';i++){
        hash = (hash + abs(value[i])%23)%size;     
    }
    return abs(hash)%size;
}
int hash3(char* value,int size){
    int hash = 1153;
    for(int i =0;value[i]!='\0';i++){
        hash = (hash*hash + abs(value[i]));
    }
    return abs(hash)%size;
}

/**
 * This hash function is taken from 
 * Source: http://www.cse.yorku.ca/~oz/hash.html
 * djb2 hash function
*/
int hash4(char* value,int size){
    int hash = 16659;
    for(int i =0;value[i]!='\0';i++){
        hash = ((hash << 5) + hash + abs(value[i]))%size;
    }
    return abs(hash%size);
}

/**
 * This hash function is taken from
 * Source: http://www.cse.yorku.ca/~oz/hash.html
 * sdbm hash function
*/
int hash5(char* value,int size){
    int hash = 57;
    for(int i =0;value[i]!='\0';i++){
        hash = abs(value[i] + (hash << 6) + (hash << 16) - hash)%size;
    }
    return abs(hash%size);
}

/**
 * Insert the given word into bit array
 * Parameter bitArray is the bitArray to be modified
 * Parameter size is the size of bitArray
 * Parameter s is the string to be inserted
*/
void insert(char* bitArray, int size, char* s){
    setBit(bitArray,hash1(s, size));
    setBit(bitArray,hash2(s, size)); 
    setBit(bitArray,hash3(s, size));
    setBit(bitArray,hash4(s, size));
    setBit(bitArray,hash5(s, size));
}

/**
 * Lookup the query word given in the bit array
 * Parameter bitArray is the bitArray to refer
 * Parameter size is the size of bitArray
 * Parameter s is the string to be checked
*/
bool lookUp(char* bitArray, int size, char* s){

    return (int)checkBit(bitArray,hash1(s, size)) 
        && (int)checkBit(bitArray,hash2(s, size)) 
        && (int)checkBit(bitArray,hash3(s, size))
        && (int)checkBit(bitArray,hash4(s, size)) 
        && (int)checkBit(bitArray,hash5(s, size));
}


/**
 * Function the reads total number of rows in the file
 * Parameter file name to identify the file
*/
int getNumberOfRows(char *fileName){
    FILE * filePointer = fopen(fileName,"r");
    int numOfRows = 0;
    char row[MAXCHAR];
    fgets(row,MAXCHAR,filePointer); // ignore header row
    while(fgets(row,MAXCHAR,filePointer)){
        numOfRows ++; // increment the number of row
    }
    fclose(filePointer);
    return numOfRows;
}

/**
 * Reads all the content of the file into and array
 * Parameter filename to identify the file
 * Parameter list is the array to insert
 * Parameter startIndex to indicate first index of the array
 * Parameter endIndex to indicate the last index of the array 
*/
void putRowsInArray(char *fileName, char ** list, int startIndex, int endIndex){
    FILE * filePointer = fopen(fileName,"r");
    char row[MAXCHAR];
    fgets(row,MAXCHAR,filePointer); // ignore header row
    for(int j = startIndex; j<endIndex;j++){
        fgets(row,MAXCHAR,filePointer);
        list[j] = strdup(row); // insert current row into array
    }
    fclose(filePointer);

}