import json

from sklearn.preprocessing import LabelEncoder

import numpy as np

from sklearn.ensemble import RandomForestClassifier

from sklearn.model_selection import train_test_split

from sklearn.metrics import precision_score

from sklearn.metrics import recall_score

from sklearn.metrics import f1_score

from sklearn.metrics import accuracy_score

from sklearn.neighbors import KNeighborsClassifier

from sklearn.naive_bayes import GaussianNB

from sklearn import svm


with open('/home/george/Downloads/thesis/benign_dataset/ben_final.json', 'r') as file:
    data = file.read().replace('\n', '')
    
mydata  = json.loads(data)

final_data=[]

le = LabelEncoder()

ben_ciph1, ben_ciph2, ben_ciph3 = 0, 0, 0

mal_ciph1, mal_ciph2, mal_ciph3, mal_ciph4, mal_ciph5, mal_ciph6, mal_ciph7, mal_ciph8, mal_ciph9, mal_ciph10, mal_ciph11, mal_ciph12, mal_ciph13, mal_ciph14, mal_ciph15, mal_ciph16, mal_ciph17, mal_ciph18, mal_ciph19, mal_ciph20, mal_ciph21, mal_ciph22, mal_ciph23, mal_ciph24, mal_ciph25, mal_ciph26, mal_ciph27, mal_ciph28, mal_ciph29, mal_ciph30, mal_ciph31, mal_ciph32, mal_ciph33, mal_ciph34, mal_ciph35, mal_ciph36, mal_ciph37, mal_ciph38 = 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0

print('Number of Benign flows: ',len(mydata))

for i in range(len(mydata)):
    
    if 'client' in mydata[i]['tls']:
        
        temp_list=[]
        
        temp_list.append(mydata[i]['src_port'])
        
        temp_list.append(mydata[i]['dst_port'])
        
        temp_list.append(mydata[i]['src_ip'])
        
        temp_list.append(mydata[i]['dst_ip'])
        
        
        temp_list.append(mydata[i]['tls']['client']['cipher_suites'])
        
        if mydata[i]['tls']['client']['cipher_suites'] == '002f00350005000ac013c014c009c00a0032003800130004':
            ben_ciph1 = ben_ciph1 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '003c002f003d00350005000ac027c013c014c02bc023c02cc024c009c00a00400032006a003800130004':
            ben_ciph2 = ben_ciph2 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c02bc02fcca9cca8c02cc030c00ac009c013c01400330039002f0035000a':
            ben_ciph3 = ben_ciph3 +1
        else:
            pass
        
        temp_list.append(mydata[i]['tls']['client']['server_name'])
        
        temp_list.append('unknown')
        temp_list.append('unknown')
        temp_list.append('unknown')
        temp_list.append('unknown')


        
        temp_list.append('neg')
        
        final_data.append(temp_list)
        
    if 'server' in mydata[i]['tls'] and 'certs' in mydata[i]['tls']['server']:
        temp_list=[]
        
        temp_list.append(mydata[i]['src_port'])
        
        temp_list.append(mydata[i]['dst_port'])
        
        temp_list.append(mydata[i]['src_ip'])
        
        temp_list.append(mydata[i]['dst_ip'])
        
        
        temp_list.append('unknown')
        
        temp_list.append('unknown')
        
        
        if 'subject_public_key_info' in mydata[i]['tls']['server']['certs'][0]['cert']:
            temp_list.append(mydata[i]['tls']['server']['certs'][0]['cert']['subject_public_key_info']['algorithm_identifier']['algorithm'])
        
        else:
            temp_list.append('unknown')
            
            
        
        if 'extensions' in mydata[i]['tls']['server']['certs'][0]['cert']:
            if 'subject_key_identifier' in mydata[i]['tls']['server']['certs'][0]['cert']['extensions']:
                temp_list.append(mydata[i]['tls']['server']['certs'][0]['cert']['extensions']['subject_key_identifier'])
	
            else:
		
                temp_list.append('unknown')
        else:
            temp_list.append('unknown')


        if 'extensions' in mydata[i]['tls']['server']['certs'][0]['cert']:
            if 'authority_key_identifier' in mydata[i]['tls']['server']['certs'][0]['cert']['extensions']:
                temp_list.append(mydata[i]['tls']['server']['certs'][0]['cert']['extensions']['authority_key_identifier'])
                
            else:
            
                temp_list.append('unknown')
        else:
            temp_list.append('unknown')

            
            
        temp_list.append(mydata[i]['tls']['server']['certs'][0]['cert']['validity'][0]['not_before'])

        temp_list.append('neg')
        
        final_data.append(temp_list)
        
    tlsv1 = 0
    tlsv2 = 0
    tlsv3 = 0
        
    if 'fingerprints' in mydata[i]:
        if 'tls' in mydata[i]['fingerprints']: 
            if mydata[i]['fingerprints']['tls'][1:5] == '0301':
                tlsv1 = tlsv1 +1
            elif mydata[i]['fingerprints']['tls'][1:5] == '0302':
                tlsv2 = tlsv2 +1
            elif mydata[i]['fingerprints']['tls'][1:5] == '0303':
                tlsv3 = tlsv3 +1
            else:
                pass
        elif 'tls_server' in mydata[i]['fingerprints']:
            if mydata[i]['fingerprints']['tls_server'][1:5] == '0301':
                tlsv1 = tlsv1 +1
            elif mydata[i]['fingerprints']['tls_server'][1:5] == '0302':
                tlsv2 = tlsv2 +1
            elif mydata[i]['fingerprints']['tls_server'][1:5] == '0303':
                tlsv3 = tlsv3 +1
            else:
                pass
    else:
        pass
        

with open('/home/george/Downloads/thesis/malware_dataset/mal_final.json', 'r') as file:
    data = file.read().replace('\n', '')
    
mydata  = json.loads(data)

print('Number of Malware flows: ',len(mydata))

for i in range(len(mydata)):
    
    if 'client' in mydata[i]['tls']:
        
        temp_list=[]
        
        temp_list.append(mydata[i]['src_port'])
        
        temp_list.append(mydata[i]['dst_port'])
        
        temp_list.append(mydata[i]['src_ip'])
        
        temp_list.append(mydata[i]['dst_ip'])
        
        temp_list.append(mydata[i]['tls']['client']['cipher_suites'])
        
        if mydata[i]['tls']['client']['cipher_suites'] == '003c002f003d00350005000ac027c013c014c02bc023c02cc024c009c00a00400032006a003800130004':
            mal_ciph1 = mal_ciph1 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '002f00350005000ac013c014c009c00a0032003800130004':
            mal_ciph2 = mal_ciph2 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c011c007c00cc0020005c014c00a0039003800880087c00fc00500350084c013c0090033003200450044c00ec004002f0041c012c00800160013c00dc003000a00ff':
            mal_ciph3 = mal_ciph3 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c028c027c014c013009f009e009d009c003d003c0035002fc02cc02bc024c023c00ac009006a004000380032000a001300050004':
            mal_ciph4 = mal_ciph4 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '000400050009002f0035003c003d':
            mal_ciph5 = mal_ciph5 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c014c013c00ac0090035002f00380032000a001300050004':
            mal_ciph6 = mal_ciph6 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c00ac0140088008700390038c00fc00500840035c007c009c011c0130045004400330032c00cc00ec002c0040096004100040005002fc008c01200160013c00dc003feff000a00ff':
            mal_ciph7 = mal_ciph7 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c00ac0140088008700390038c00fc00500840035c007c009c011c01300450044006600330032c00cc00ec002c0040096004100050004002fc008c01200160013c00dc003feff000a':
            mal_ciph8 = mal_ciph8 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'cacac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph9 = mal_ciph9 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '4a4ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph10 = mal_ciph10 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '7a7ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph11 = mal_ciph11 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '6a6ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph12 = mal_ciph12 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'dadac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph13 = mal_ciph13 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c028c027c014c013009f009e00390033009d009c003d003c0035002fc02cc02bc024c023c00ac009006a004000380032000a0013':
            mal_ciph14 = mal_ciph14 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '1a1ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph15 = mal_ciph15 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '2a2ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph16 = mal_ciph16 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c02bc02fc00ac009c013c014c012c007c0110033003200450039003800880016002f004100350084000a0005000400ff':
            mal_ciph17 = mal_ciph17 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c02bc02cc02fc030009e009fc009c00ac013c01400330039c007c011009c009d002f0035000500ff':
            mal_ciph18 = mal_ciph18 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c02bc02fc00ac009c013c014c01200330032003900380016002f0035000a00ff':
            mal_ciph19 = mal_ciph19 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c030c02cc028c024c014c00a00a500a300a1009f006b006a006900680039003800370036c032c02ec02ac026c00fc005009d003d0035c02fc02bc027c023c013c00900a400a200a0009e00670040003f003e0033003200310030009a009900980097c031c02dc029c025c00ec004009c003c002f0096c012c008001600130010000dc00dc003000a00ff':
            mal_ciph20 = mal_ciph20 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'aaaac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph21 = mal_ciph21 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'eaeac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph22 = mal_ciph22 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '5a5ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph23 = mal_ciph23 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '3a3ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a':
            mal_ciph24 = mal_ciph24 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'cca9cca8cc14cc13c02bc02fc02cc030c009c013c00ac014009c009d002f0035000a':
            mal_ciph25 = mal_ciph25 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '8a8ac02bc02fc02cc030cca9cca8c013c014009c009d002f0035000a':
            mal_ciph26 = mal_ciph26 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '0a0ac02bc02fc02cc030cca9cca8c013c014009c009d002f0035000a':
            mal_ciph27 = mal_ciph27 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '0033002f0035000a0005000400ff':
            mal_ciph28 = mal_ciph28 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c0270067009cc011c007c00cc0020005c030c02cc028c024c014c00a00a500a300a1009f006b006a0069006800390038003700360088008700860085c032c02ec02ac026c00fc005009d003d00350084c02fc02bc023c013c00900a400a200a0009e0040003f003e00330032003100300045004400430042c031c02dc029c025c00ec004003c002f004100ff':
            mal_ciph29 = mal_ciph29 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'cca9cca8cc14cc13c02bc02fc00ac014c009c013009c0035002f000a':
            mal_ciph30 = mal_ciph30 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c02cc030009fcca9cca8ccaac02bc02f009ec024c028006bc023c0270067c00ac0140039c009c0130033009d009c003d003c0035002f00ff':
            mal_ciph31 = mal_ciph31 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '130213031301c02fc02bc030c02c009ec0270067c028006b00a3009fcca9cca8ccaac0afc0adc0a3c09fc05dc061c057c05300a2c0aec0acc0a2c09ec05cc060c056c052c024006ac0230040c00ac01400390038c009c01300330032009dc0a1c09dc051009cc0a0c09cc050003d003c0035002f00ff':
            mal_ciph32 = mal_ciph32 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == '130113031302c02bc02fcca9cca8c02cc030c00ac009c013c01400330039002f0035000a':
            mal_ciph33 = mal_ciph33 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c030c02cc028c024c014c00a00a500a300a1009f006b006a0069006800390038003700360088008700860085c032c02ec02ac026c00fc005009d003d00350084c02fc02bc027c023c013c00900a400a200a0009e00670040003f003e0033003200310030009a0099009800970045004400430042c031c02dc029c025c00ec004009c003c002f00960041c012c008001600130010000dc00dc003000a0007c011c007c00cc0020005000400ff':
            mal_ciph34 = mal_ciph34 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c030c02fc028c027c014c013009f009e009d009c003d003c0035002fc02cc02bc024c023c00ac009006a004000380032000a0013':
            mal_ciph35 = mal_ciph35 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'fafa130113021303c02bc02fc02cc030cca9cca8c013c014009c009d002f0035':
            mal_ciph36 = mal_ciph6 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c02cc02bc030c02fc024c023c028c027c00ac009c014c013009d009c003d003c0035002f000a':
            mal_ciph37 = mal_ciph37 +1
        elif mydata[i]['tls']['client']['cipher_suites'] == 'c02fc030c02bc02ccca8cca9c013c009c014c00a009c009d002f0035c012000a130113031302':
            mal_ciph38 = mal_ciph38 +1
        else:
            pass
        
        
        if 'server_name' in mydata[i]['tls']['client']:
        
            temp_list.append(mydata[i]['tls']['client']['server_name'])
            
        else:
            temp_list.append('unknown')

        
        temp_list.append('unknown')
        temp_list.append('unknown')
        temp_list.append('unknown')
        temp_list.append('unknown')
        
        temp_list.append('pos')
        
        final_data.append(temp_list)

    if 'server' in mydata[i]['tls'] and 'certs' in mydata[i]['tls']['server']:
        
        temp_list=[]
        
        temp_list.append(mydata[i]['src_port'])
        
        temp_list.append(mydata[i]['dst_port'])
        
        temp_list.append(mydata[i]['src_ip'])
        
        temp_list.append(mydata[i]['dst_ip'])
        
        
        temp_list.append('unknown')
        
        temp_list.append('unknown')
        
        
        if 'subject_public_key_info' in mydata[i]['tls']['server']['certs'][0]['cert']:
        
            temp_list.append(mydata[i]['tls']['server']['certs'][0]['cert']['subject_public_key_info']['algorithm_identifier']['algorithm'])
        
        else:
            temp_list.append('unknown')
        
        
        if 'extensions' in mydata[i]['tls']['server']['certs'][0]['cert']:
            if 'subject_key_identifier' in mydata[i]['tls']['server']['certs'][0]['cert']['extensions']:    

                temp_list.append(mydata[i]['tls']['server']['certs'][0]['cert']['extensions']['subject_key_identifier'])

            else:
                temp_list.append('unknown')
                
        else:
            temp_list.append('unknown')
            
            
            
        if 'extensions' in mydata[i]['tls']['server']['certs'][0]['cert']:
            if 'authority_key_identifier' in mydata[i]['tls']['server']['certs'][0]['cert']['extensions']: 
                
                temp_list.append(mydata[i]['tls']['server']['certs'][0]['cert']['extensions'][i]['authority_key_identifier'])
                
            else:
                temp_list.append('unknown')
                
        else:
            temp_list.append('unknown')


        
        temp_list.append(mydata[i]['tls']['server']['certs'][0]['cert']['validity'][0]['not_before'])

        temp_list.append('pos')
        
        final_data.append(temp_list)
        
            
    if 'fingerprints' in mydata[i]:
        if 'tls' in mydata[i]['fingerprints']: 
            if mydata[i]['fingerprints']['tls'][1:5] == '0301':
                tlsv1 = tlsv1 +1
            elif mydata[i]['fingerprints']['tls'][1:5] == '0302':
                tlsv2 = tlsv2 +1
            elif mydata[i]['fingerprints']['tls'][1:5] == '0303':
                tlsv3 = tlsv3 +1
            else:
                pass
        elif 'tls_server' in mydata[i]['fingerprints']:
            if mydata[i]['fingerprints']['tls_server'][1:5] == '0301':
                tlsv1 = tlsv1 +1
            elif mydata[i]['fingerprints']['tls_server'][1:5] == '0302':
                tlsv2 = tlsv2 +1
            elif mydata[i]['fingerprints']['tls_server'][1:5] == '0303':
                tlsv3 = tlsv3 +1
            else:
                pass
    else:
        pass
        
print('\nTLS version 1: ', tlsv1)
print('TLS version 2: ', tlsv2)
print('TLS version 3: ', tlsv3)

print("\nBenign ciphersuites: \n")
print("1) 002f00350005000ac013c014c009c00a0032003800130004: ", ben_ciph1)
print("2) 003c002f003d00350005000ac027c013c014c02bc023c02cc024c009c00a00400032006a003800130004: ", ben_ciph2)
print("3) c02bc02fcca9cca8c02cc030c00ac009c013c01400330039002f0035000a: ", ben_ciph3)

print("\nMalware ciphersuites: \n")
print("1) 003c002f003d00350005000ac027c013c014c02bc023c02cc024c009c00a00400032006a003800130004: ", mal_ciph1)
print("2) 002f00350005000ac013c014c009c00a0032003800130004: ", mal_ciph2)
print("3) c011c007c00cc0020005c014c00a0039003800880087c00fc00500350084c013c0090033003200450044c00ec004002f0041c012c00800160013c00dc003000a00ff: ", mal_ciph3)
print("4) c028c027c014c013009f009e009d009c003d003c0035002fc02cc02bc024c023c00ac009006a004000380032000a001300050004: ", mal_ciph4)
print("5) 000400050009002f0035003c003d: ", mal_ciph5)
print("6) c014c013c00ac0090035002f00380032000a001300050004: ", mal_ciph6)
print("7) c00ac0140088008700390038c00fc00500840035c007c009c011c0130045004400330032c00cc00ec002c0040096004100040005002fc008c01200160013c00dc003feff000a00ff: ", mal_ciph7)
print("8) c00ac0140088008700390038c00fc00500840035c007c009c011c01300450044006600330032c00cc00ec002c0040096004100050004002fc008c01200160013c00dc003feff000a: ", mal_ciph8)
print("9) cacac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph9)
print("10) 4a4ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph10)
print("11) 7a7ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph11)
print("12) 6a6ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph12)
print("13) dadac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph13)
print("14) c028c027c014c013009f009e00390033009d009c003d003c0035002fc02cc02bc024c023c00ac009006a004000380032000a0013: ", mal_ciph14)
print("15) 1a1ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph15)
print("16) 2a2ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph16)
print("17) c02bc02fc00ac009c013c014c012c007c0110033003200450039003800880016002f004100350084000a0005000400ff: ", mal_ciph17)
print("18) c02bc02cc02fc030009e009fc009c00ac013c01400330039c007c011009c009d002f0035000500ff: ", mal_ciph18)
print("19) c02bc02fc00ac009c013c014c01200330032003900380016002f0035000a00ff: ", mal_ciph19)
print("20) c030c02cc028c024c014c00a00a500a300a1009f006b006a006900680039003800370036c032c02ec02ac026c00fc005009d003d0035c02fc02bc027c023c013c00900a400a200a0009e00670040003f003e0033003200310030009a009900980097c031c02dc029c025c00ec004009c003c002f0096c012c008001600130010000dc00dc003000a00ff: ", mal_ciph20)
print("21) aaaac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph21)
print("22) eaeac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph22)
print("23) 5a5ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph23)
print("24) 3a3ac02bc02fc02cc030cca9cca8cc14cc13c013c014009c009d002f0035000a: ", mal_ciph24)
print("25) cca9cca8cc14cc13c02bc02fc02cc030c009c013c00ac014009c009d002f0035000a: ", mal_ciph25)
print("26) 8a8ac02bc02fc02cc030cca9cca8c013c014009c009d002f0035000a: ", mal_ciph26)
print("27) 0a0ac02bc02fc02cc030cca9cca8c013c014009c009d002f0035000a: ", mal_ciph27)
print("28) 0033002f0035000a0005000400ff: ", mal_ciph28)
print("29) c0270067009cc011c007c00cc0020005c030c02cc028c024c014c00a00a500a300a1009f006b006a0069006800390038003700360088008700860085c032c02ec02ac026c00fc005009d003d00350084c02fc02bc023c013c00900a400a200a0009e0040003f003e00330032003100300045004400430042c031c02dc029c025c00ec004003c002f004100ff: ", mal_ciph29)
print("30) cca9cca8cc14cc13c02bc02fc00ac014c009c013009c0035002f000a: ", mal_ciph30)
print("31) c02cc030009fcca9cca8ccaac02bc02f009ec024c028006bc023c0270067c00ac0140039c009c0130033009d009c003d003c0035002f00ff: ", mal_ciph31)
print("32) 130213031301c02fc02bc030c02c009ec0270067c028006b00a3009fcca9cca8ccaac0afc0adc0a3c09fc05dc061c057c05300a2c0aec0acc0a2c09ec05cc060c056c052c024006ac0230040c00ac01400390038c009c01300330032009dc0a1c09dc051009cc0a0c09cc050003d003c0035002f00ff: ", mal_ciph32)
print("33) 130113031302c02bc02fcca9cca8c02cc030c00ac009c013c01400330039002f0035000a: ", mal_ciph33)
print("34) c030c02cc028c024c014c00a00a500a300a1009f006b006a0069006800390038003700360088008700860085c032c02ec02ac026c00fc005009d003d00350084c02fc02bc027c023c013c00900a400a200a0009e00670040003f003e0033003200310030009a0099009800970045004400430042c031c02dc029c025c00ec004009c003c002f00960041c012c008001600130010000dc00dc003000a0007c011c007c00cc0020005000400ff: ", mal_ciph34)
print("35) c030c02fc028c027c014c013009f009e009d009c003d003c0035002fc02cc02bc024c023c00ac009006a004000380032000a0013: ", mal_ciph35)
print("36) fafa130113021303c02bc02fc02cc030cca9cca8c013c014009c009d002f0035: ", mal_ciph36)
print("37) c02cc02bc030c02fc024c023c028c027c00ac009c014c013009d009c003d003c0035002f000a: ", mal_ciph37)
print("38) c02fc030c02bc02ccca8cca9c013c009c014c00a009c009d002f0035c012000a130113031302: ", mal_ciph38)


final_array = np.array(final_data)

final_array[:,2] = le.fit_transform(final_array[:,2])

final_array[:,3] = le.fit_transform(final_array[:,3])

final_array[:,4] = le.fit_transform(final_array[:,4])

final_array[:,5] = le.fit_transform(final_array[:,5])

final_array[:,6] = le.fit_transform(final_array[:,6])

final_array[:,7] = le.fit_transform(final_array[:,7])

final_array[:,8] = le.fit_transform(final_array[:,8])

final_array[:,9] = le.fit_transform(final_array[:,9])


X = final_array[:,0:10]

y = final_array[:,10]

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.25)


print("\nRandom Forests: \n")
#dimiourgia montelou
clf=RandomForestClassifier(n_estimators=200)

#ekpaideysi
clf.fit(X_train,y_train)

#test
y_pred=clf.predict(X_test)

precision = precision_score(y_test, y_pred, average='binary', pos_label='pos')
print('Precision: %.3f' % precision)

recall = recall_score(y_test, y_pred, average='binary',pos_label='pos')
print('Recall: %.3f' % recall)

f1 = f1_score(y_test, y_pred, average='binary',pos_label='pos')
print('F1-score: %.3f' % f1) 

accuracy = accuracy_score(y_test, y_pred)
print('Accuracy: %.3f \n' % accuracy)


knn = KNeighborsClassifier(n_neighbors=3)

#ekpaideysi
knn.fit(X_train,y_train)

#test
y_pred=knn.predict(X_test)

print("\nKNN: \n")

precision = precision_score(y_test, y_pred, average='binary', pos_label='pos')
print('Precision: %.3f' % precision)

recall = recall_score(y_test, y_pred, average='binary',pos_label='pos')
print('Recall: %.3f' % recall)

f1 = f1_score(y_test, y_pred, average='binary',pos_label='pos')
print('F1-score: %.3f' % f1) 

accuracy = accuracy_score(y_test, y_pred)
print('Accuracy: %.3f \n' % accuracy)


print("SVM: \n")
#Create a svm Classifier
clf = svm.SVC(kernel='rbf') # Radial Basis Function Kernel

#Train the model using the training sets
clf.fit(X_train, y_train)

#Predict the response for test dataset
y_pred = clf.predict(X_test)

precision = precision_score(y_test, y_pred, average='binary', pos_label='pos')
print('Precision: %.3f' % precision)

recall = recall_score(y_test, y_pred, average='binary',pos_label='pos')
print('Recall: %.3f' % recall)

f1 = f1_score(y_test, y_pred, average='binary',pos_label='pos')
print('F1-score: %.3f' % f1) 

accuracy = accuracy_score(y_test, y_pred)
print('Accuracy: %.3f \n' % accuracy)   
