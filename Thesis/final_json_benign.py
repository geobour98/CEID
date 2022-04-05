import json

with open('ben_output.json', 'r') as test:
    lineList = test.readlines()

with open('ben_output.json', 'r') as istr:
    i=0
    with open('ben_final.json', 'w') as ostr:
        print('[',file=ostr)
        for i, line in enumerate(istr):
            i=i+1
            line = line.rstrip('\n')
            if i!=len(lineList):
                line += ','
                print(line, file=ostr)
            else:
                 line += ']'
                 print(line, file=ostr)
                

with open('ben_final.json', 'r') as file:
    data = file.read().replace('\n', '')

