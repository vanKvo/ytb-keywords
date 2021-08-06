import sys
import pandas as pd
import pprint

keywords = []
dict = {}
csv_file = sys.argv[1]
#csv_file = "uploads/keywordTest.csv"

df = pd.read_csv(csv_file)

# Insert all keywords of each Youtube video into a list named keywords
for idx in df.index:
    str = df['Keywords'][idx][1:-1] # remove first and last single quote to split a string in words
    words = str.split("', '")
    for word in words:     
        keywords.append(word)

# Count # of occurences of each keyword
for keyword in keywords:
    count = keywords.count(keyword)
    dict[keyword] = count

# Sort dict in descending order. The keywords with the most occurence will appear at the top.
sorted_dict = sorted(dict.items(), key = lambda kv:(-kv[1], kv[0]))

pprint.pp(sorted_dict) 