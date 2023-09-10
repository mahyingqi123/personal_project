import csv
import secrets
import numpy as np
import string
from functools import partial

np.random.seed(0)
def produce_amount_keys(amount_of_keys, _randint=np.random.randint):
    keys = set()
    pickchar = partial(secrets.choice, string.ascii_uppercase + string.digits)
    while len(keys) < amount_of_keys:
        keys |= {''.join([pickchar() for _ in range(_randint(12, 20))]) for _ in range(amount_of_keys - len(keys))}
    return keys

queryLength = 1000000
inputLength = queryLength//2
arr = list(produce_amount_keys(queryLength))
inputfile1 = open("word1.csv", "w",newline='')
inputfile2 = open("word2.csv", "w",newline='')
inputfile3 = open("word3.csv", "w",newline='')
inputfile4 = open("word4.csv", "w",newline='')

queryfile1 = open("query1.csv", "w",newline='')
queryfile2 = open("query2.csv", "w",newline='')
queryfile3 = open("query3.csv", "w",newline='')
queryfile4 = open("query4.csv", "w",newline='')

writeInput1 = csv.writer(inputfile1,escapechar = "\\")
writeInput2 = csv.writer(inputfile2,escapechar = "\\")
writeInput3 = csv.writer(inputfile3,escapechar = "\\")
writeInput4 = csv.writer(inputfile4,escapechar = "\\")
writeQuery1 = csv.writer(queryfile1,escapechar = "\\")
writeQuery2 = csv.writer(queryfile2,escapechar = "\\")
writeQuery3 = csv.writer(queryfile3,escapechar = "\\")
writeQuery4 = csv.writer(queryfile4,escapechar = "\\")

writeInput1.writerow(["Value"])
writeInput2.writerow(["Value"])
writeInput3.writerow(["Value"])
writeInput4.writerow(["Value"])

writeQuery1.writerow(["Value"]+["Exist"])
writeQuery2.writerow(["Value"]+["Exist"])
writeQuery3.writerow(["Value"]+["Exist"])
writeQuery4.writerow(["Value"]+["Exist"])

for item in arr[:inputLength//4]:
    writeInput1.writerow([item])
    writeQuery1.writerow([item]+[1])

for item in arr[inputLength//4:inputLength//2]:
    writeInput2.writerow([item])
    writeQuery2.writerow([item]+[1])

for item in arr[inputLength//2:(inputLength//4)*3]:
    writeInput3.writerow([item])
    writeQuery3.writerow([item]+[1])

for item in arr[(3*inputLength//4):inputLength]:
    writeInput4.writerow([item])
    writeQuery4.writerow([item]+[1])

for item in arr[inputLength:((queryLength-inputLength)//4)+inputLength]:
    writeQuery1.writerow([item]+[0])

for item in arr[((queryLength-inputLength)//4)+inputLength:(queryLength-inputLength)//2+inputLength]:
    writeQuery2.writerow([item]+[0])

for item in arr[(queryLength-inputLength)//2+inputLength:(3*(queryLength-inputLength))//4+inputLength]:
    writeQuery3.writerow([item]+[0])


for item in arr[(3*(queryLength-inputLength))//4+inputLength:]:
    writeQuery4.writerow([item]+[0])

inputfile1.close()
inputfile2.close()
inputfile3.close()
inputfile4.close()
queryfile1.close()
queryfile2.close()
queryfile3.close()
queryfile4.close()



