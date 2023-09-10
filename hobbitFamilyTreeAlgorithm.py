"""
Template for Programming Assignment FIT1045 - OCT 2021
Family Trees

In this assignment we create a Python module to implement some
basic family tree software, where users can look up various relationships
that exist in the database, as well as merging two family tree databases
that may contain overlapping information.

Functions  1-7 are due in Part 1 of the assignment. Functions
for 8 and 9 are due in Part 2.

We represent each entry in a family tree database as a list of three
strings [name, father, mother], where name is a person's name, father
is the name of their father, and mother is the name of their mother.
Where a particular relationship is unknown, the value None is used.
For example:

>>> duck_tree = [['Fergus McDuck', None, None],
...           ['Downy ODrake', None, None],
...           ['Quackmore Duck', None, None],
...           ['Donald Duck','Quackmore Duck','Hortense McDuck'],
...           ['Della Duck', 'Quackmore Duck', 'Hortense McDuck'],
...           ['Hortense McDuck', 'Fergus McDuck', 'Downy ODrake'],
...           ['Scrooge McDuck', 'Fergus McDuck', 'Downy ODrake'],
...           ['Huey Duck', None, 'Della Duck'],
...           ['Dewey Duck', None, 'Della Duck'],
...           ['Louie Duck', None, 'Della Duck']]


The file hobbit-family.txt is also provided for testing. The database
used in this file has been compiled using the info at
http://lotrproject.com/hobbits.php. Character names are by J.R.R. Tolkein.

For more information see the function documentations below and the
assignment sheet.

"""

# Part 1 (due Week 6) #
from math import inf


def read_family(filename):
    """
    Input: A filename (filename) containing a family tree database where
    each line is in the form name, father, mother
    Output: A family tree database containing the contents of the file
    in the format specified above, or None if the file is in the incorrect
    format.

    For example:

    >>> hobbits = read_family('hobbit-family.txt')
    >>> len(hobbits)
    119
    >>> hobbits[118]
    ['Sancho Proudfoot', 'Olo Proudfoot', None]

     """
    file = open(filename)
    res = []
    for line in file:
        res += [line.strip()]

    database = []

    for i in range(len(res)):
        k = res[i].split(',')
        temp = []
        for j in range(3):
            x = k[j].strip()
            temp += [x]

        database += [temp]

    for i in range(0, len(database)):
        for j in range(0, len(database[i])):
            if database[i][j] == '':
                database[i][j] = None
    return database


def person_index(person, family):
    """
    Input: A person's name (person) and a family tree database (family)
            as specified above.
    Output: The index value of the person's entry in the family tree,
            or None if they have no entry.

    For example:
    >>> duck_tree = [['Fergus McDuck', None, None],
    ...           ['Downy ODrake', None, None],
    ...           ['Quackmore Duck', None, None],
    ...           ['Donald Duck','Quackmore Duck','Hortense McDuck'],
    ...           ['Della Duck', 'Quackmore Duck', 'Hortense McDuck'],
    ...           ['Hortense McDuck', 'Fergus McDuck', 'Downy ODrake'],
    ...           ['Scrooge McDuck', 'Fergus McDuck', 'Downy ODrake'],
    ...           ['Huey Duck', None, 'Della Duck'],
    ...           ['Dewey Duck', None, 'Della Duck'],
    ...           ['Louie Duck', None, 'Della Duck']]
    >>> person_index('Dewey Duck', duck_tree)
    8
    >>> person_index('Daffy Duck', duck_tree)

    >>> person_index(None, duck_tree)
    """
    for i in range(len(family)):
        if family[i][0] == person:
            return i

    return None


def father(person, family):
    """
    Input: A person's name (person) and a family tree database (family)
            as specified above.
    Output: The name of person's father, or None if the information is
            not in the database.

    For example:
    >>> duck_tree = [['Fergus McDuck', None, None],
    ...           ['Downy ODrake', None, None],
    ...           ['Quackmore Duck', None, None],
    ...           ['Donald Duck','Quackmore Duck','Hortense McDuck'],
    ...           ['Della Duck', 'Quackmore Duck', 'Hortense McDuck'],
    ...           ['Hortense McDuck', 'Fergus McDuck', 'Downy ODrake'],
    ...           ['Scrooge McDuck', 'Fergus McDuck', 'Downy ODrake'],
    ...           ['Huey Duck', None, 'Della Duck'],
    ...           ['Dewey Duck', None, 'Della Duck'],
    ...           ['Louie Duck', None, 'Della Duck']]
    >>> father('Della Duck', duck_tree)
    'Quackmore Duck'
    >>> father('Huey Duck', duck_tree)

    >>> father('Daffy Duck', duck_tree)

    """
    people = person_index(person, family)
    if people is not None:
        return family[people][1]
    return None


def mother(person, family):
    """
    Input: A person's name (person) and a family tree database (family)
            as specified above.
    Output: The name of person's mother, or None if the information is
            not in the database.

    For example:
    >>> duck_tree = [['Fergus McDuck', None, None],
    ...           ['Downy ODrake', None, None],
    ...           ['Quackmore Duck', None, None],
    ...           ['Donald Duck','Quackmore Duck','Hortense McDuck'],
    ...           ['Della Duck', 'Quackmore Duck', 'Hortense McDuck'],
    ...           ['Hortense McDuck', 'Fergus McDuck', 'Downy ODrake'],
    ...           ['Scrooge McDuck', 'Fergus McDuck', 'Downy ODrake'],
    ...           ['Huey Duck', None, 'Della Duck'],
    ...           ['Dewey Duck', None, 'Della Duck'],
    ...           ['Louie Duck', None, 'Della Duck']]
    >>> mother('Hortense McDuck', duck_tree)
    'Downy ODrake'
    >>> mother('Fergus McDuck', duck_tree)

    >>> mother('Daffy Duck', duck_tree)

    """
    people = person_index(person, family)
    if people is not None:
        return family[people][2]
    return None


def children(person, family):
    """
    Input: A person's name (person) and a family tree database (family)
            as specified above.
    Output: A list containing the names of all of person's children.

    For example:
    >>> duck_tree = [['Fergus McDuck', None, None],
    ...           ['Downy ODrake', None, None],
    ...           ['Quackmore Duck', None, None],
    ...           ['Donald Duck','Quackmore Duck','Hortense McDuck'],
    ...           ['Della Duck', 'Quackmore Duck', 'Hortense McDuck'],
    ...           ['Hortense McDuck', 'Fergus McDuck', 'Downy ODrake'],
    ...           ['Scrooge McDuck', 'Fergus McDuck', 'Downy ODrake'],
    ...           ['Huey Duck', None, 'Della Duck'],
    ...           ['Dewey Duck', None, 'Della Duck'],
    ...           ['Louie Duck', None, 'Della Duck']]
    >>> sorted(children('Della Duck', duck_tree))
    ['Dewey Duck', 'Huey Duck', 'Louie Duck']
    >>> children('Donald Duck', duck_tree)
    []
    >>> sorted(children('Fergus McDuck', duck_tree))
    ['Hortense McDuck', 'Scrooge McDuck']
    >>> children('Donald Mallard', duck_tree)
    []

    """
    res = []
    if person is not None:
        for i in range(len(family)):
            if family[i][1] == person or family[i][2] == person:
                res += [family[i][0]]
    return res


def grandchildren(person, family):
    """
    Input: A person's name (person) and a family tree database (family)
            as specified above.
    Output: A list containing only the names of the grandchildren of person
        that are stored in the database.

    For example:
    >>> duck_tree = [['Fergus McDuck', 'Dingus McDuck', 'Molly Mallard'],
    ...           ['Downy ODrake', None, None],
    ...           ['Quackmore Duck', None, None],
    ...           ['Donald Duck','Quackmore Duck','Hortense McDuck'],
    ...           ['Della Duck', 'Quackmore Duck', 'Hortense McDuck'],
    ...           ['Hortense McDuck', 'Fergus McDuck', 'Downy ODrake'],
    ...           ['Scrooge McDuck', 'Fergus McDuck', 'Downy ODrake'],
    ...           ['Huey Duck', None, 'Della Duck'],
    ...           ['Dewey Duck', None, 'Della Duck'],
    ...           ['Louie Duck', None, 'Della Duck']]
    >>> sorted(grandchildren('Quackmore Duck', duck_tree))
    ['Dewey Duck', 'Huey Duck', 'Louie Duck']
    >>> sorted(grandchildren('Downy ODrake', duck_tree))
    ['Della Duck', 'Donald Duck']
    >>> grandchildren('Della Duck', duck_tree)
    []

    """
    child = children(person, family)
    res = []

    for i in child:
        res += children(i, family)

    return res


def cousins(person, family):
    """
    Input: A person's name (person) and a family tree database (family)
            as specified above.
    Output: A list containing the names of all cousins of person that
            are stored in the database.

    For example:

    >>> hobbits = read_family('hobbit-family.txt')
    >>> sorted(cousins('Frodo Baggins', hobbits))
    ['Daisy Baggins', 'Merimac Brandybuck', 'Milo Burrows', 'Saradoc Brandybuck', 'Seredic Brandybuck']

    """
    res = []
    mama = mother(person, family)
    papa = father(person, family)
    if papa is not None:
        grandpa = father(papa, family)
        if grandpa is None:
            grandpa = mother(papa, family)
        if grandpa is not None:
            res += grandchildren(grandpa, family)
    if mama is not None:
        grandma = mother(mama, family)
        if grandma is None:
            grandma = father(mama, family)
        if grandma is not None:
            res += grandchildren(grandma, family)
    if mama is not None:
        siblings = children(mama, family)
    elif papa is not None:
        siblings = children(papa, family)
    else:
        siblings = []
    i = 0
    while i < len(res):
        if res[i] in siblings:
            res.remove(res[i])
        else:
            i += 1
    return res


# # Part 2: (due Week 11) #

def direct_ancestor(p1, p2, family):
    """
    Input: Two names (p1, p2) and a family tree database (family).
    Output: One of the following three string outputs (where p1 and
            p2 are the given input strings, and n is a non-negative integer):
            "p1 is a direct ancestor of p2, n generations apart."
            "p2 is a direct ancestor of p1, n generations apart."
            "p1 is not a direct ancestor or descendant of p2."

    For example:

    >>> hobbits = read_family('hobbit-family.txt')
    >>> direct_ancestor('Frodo Baggins', 'Frodo Baggins', hobbits)
    'Frodo Baggins is a direct ancestor of Frodo Baggins, 0 generations apart.'
    >>> direct_ancestor('Frodo Baggins', 'Gormadoc Brandybuck', hobbits)
    'Gormadoc Brandybuck is a direct ancestor of Frodo Baggins, 5 generations apart.'
    """

    def ancestor_degree(z1, z2, fam):  # Nested recursive function to find degree of ancestor
        if z1 == z2:
            return 0  # Return 0 if z1 == z2
        elif z1 is None or z2 is None:
            return None  # Return None if z2 is not found
        else:
            f1 = father(z1, fam)  # Find father of z1
            m1 = mother(z1, fam)  # Find mother of z1
            count1 = ancestor_degree(f1, z2, fam)  # Recursive occurs here
            if count1 is not None:
                return count1 + 1  # add one and return if z2 is found in ancestor

            # proceed with mother side if z2 is not found in ancestor

            count2 = ancestor_degree(m1, z2, fam)  # Recursive occurs here
            if count2 is not None:
                return count2 + 1  # add one and return if z2 is found in ancestor
            return None  # return none if z2 is not found on either father or mother side

    if p1 is None or p2 is None:  # If either one of p1 and p2 is none, they are not related
        return str(p1) + " is not a direct ancestor or descendant of " + str(p2) + "."
    else:
        x = ancestor_degree(p1, p2, family)  # First attempt to get ancestor degree
        if x is None:  # If p2 is not an ancestor of p1, test if p1 is an ancestor of p2
            x = ancestor_degree(p2, p1, family)  # Second attempt to get ancestor degree
            if x is None:  # If still not, they are not related
                return str(p1) + " is not a direct ancestor or descendant of " + str(p2) + "."
            else:  # p1 is an ancestor of p2
                return str(p1) + " is a direct ancestor of " + str(p2) + ", " + str(x) + " generations apart."
        else:  # p2 is an ancestor of p1
            return str(p2) + " is a direct ancestor of " + str(p1) + ", " + str(x) + " generations apart."


def cousin_degree(p1, p2, family):
    """
    Input: Two names (p1, p2) and a family tree database (family).
    Output: A number representing the minimum distance cousin relationship between p1 and p2, as follows:
            -   0 if p1 and p2 are siblings
            -   1 if p1 and p2 are cousins
            -   n if p1 and p2 are nth cousins, as defined at https://www.familysearch.org/blog/en/cousin-chart/
            -   -1 if p1 and p2 have no cousin or sibling relationship

    For example:
    >>> hobbits = read_family("hobbit-family.txt")
    >>> cousin_degree('Minto Burrows', 'Myrtle Burrows', hobbits)
    0
    >>> cousin_degree('Estella Bolger', 'Meriadoc Brandybuck', hobbits)
    3
    >>> cousin_degree('Frodo Baggins', 'Bilbo Baggins', hobbits)
    -1
    """

    def siblings(z, b):  # Nested function to check if two persons are siblings
        dad = father(z, family)
        if b in children(dad, family):
            return True
        else:
            return False

    def ancestor_degree(z1, z2, fam):  # Nested function taken from direct_ancestor()
        if z1 == z2:
            return 0
        elif z1 is None or z2 is None:
            return None
        else:
            father1 = father(z1, fam)
            mother1 = mother(z1, fam)
            count1 = ancestor_degree(father1, z2, fam)
            if count1 is not None:
                return count1 + 1
            count2 = ancestor_degree(mother1, z2, fam)
            if count2 is not None:
                return count2 + 1
            return None

    def find_ancestors(k, fam):  # Put all ancestors in one list
        lstmom = []
        lstdad = []

        dad = father(k, fam)
        mom = mother(k, fam)
        if dad is not None:
            lstdad += [dad]
            lstdad += find_ancestors(dad, fam)
        if mom is not None:
            lstmom += [mom]
            lstmom += find_ancestors(mom, fam)
        return lstdad + lstmom

    # Actual executing code part
    if siblings(p1, p2):  # If they are siblings, their degree is zero
        return 0
    else:
        f1 = find_ancestors(p1, family)  # Find ancestors of p1
        all_ancestors1 = f1  # All ancestors of p1
        f2 = find_ancestors(p2, family)  # Find ancestors of p2
        all_ancestors2 = f2  # All ancestors of p2
        common_ancestor1 = []
        for i in all_ancestors1:
            if i in all_ancestors2:  # Find if p1 and p2 have common ancestor
                common_ancestor1 += [i]  # Add common ancestor to list
        common_ancestor2 = []
        for i in common_ancestor1:
            a = ancestor_degree(p1, i, family)
            c = ancestor_degree(p2, i, family)
            if a == c:  # Check if they have same ancestor degree with the person found
                common_ancestor2 += [i]  # Record ancestor with same degree
        if len(common_ancestor2) > 0:
            recorder = inf
            for i in common_ancestor2:  # Find ancestor with smallest ancestor degree(closest ancestor, closest cousin degree)
                a = ancestor_degree(p1, i, family)
                if a < recorder:
                    recorder = a
            return recorder - 1  # -1 because cousin degree starts counting from grandparents
        else:
            return -1


if __name__ == "__main__":
    import doctest

    doctest.testmod(verbose=True)
