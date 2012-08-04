# -*- coding=utf-8 -*-

##########################################################
#   Desc    :   Get PageRank of a Website, for Python
#   Author  :   iSayme
#   E-Mail  :   isaymeorg@gmail.com
#   Website :   http://www.isayme.org
#   Date    :   2012-08-04
##########################################################

import os, sys
import urllib2

def GetPR(domain = 'isayme.org'):
    # Get PageRank of Your Website
    GPR_HASH_SEED = "Mining PageRank is AGAINST GOOGLE'S TERMS OF SERVICE. Yes, I'm talking to you, scammer."
    
    domain = domain.replace('http://','').strip()

    magic = 0x1020345
    for i in xrange(len(domain)):
        magic ^= ord(GPR_HASH_SEED[i % len(GPR_HASH_SEED)]) ^ ord(domain[i])
        magic = (magic >> 23 | magic << 9) & 0xFFFFFFFF
    chksum = "8%08x" % (magic)
    
    url = "http://toolbarqueries.google.com/tbr?client=navclient-auto&features=Rank&ch=%s&q=info:%s" \
            %(chksum, domain)

    data = urllib2.urlopen(url).read().split(":")

    return int(data[len(data) - 1])
    
if __name__ == "__main__":
    print GetPR('isayme.org')
