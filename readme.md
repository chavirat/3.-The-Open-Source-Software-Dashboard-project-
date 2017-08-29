<h1>OSS Dashboard Calculation</h1>
<h3>Summary tab</h3>
<h5>Percentage of Audits containing Open Source Software (OSS)</h5>
<p>Percentage of Audits with OSS = Number of audits containing OSS/ total number of audits * 100</p>
<p>Percentage of Audit without OSS = 100 - Percentage of Audits with OSS</p>
<h5>Sankey chart structure</h5>
<p>Total number of files -> divided by software model -> license type -> license base</p>
<p>Percentage of Total number of files = 100</p>
<p>Percentage of Files per Software model </p>
= sum of number of files for each software model / sum of number of files * 100
Percentage of Files per license type 
= sum of number of files for each license type/ sum of number of files * 100
Percentage of license base including
1.	No license information = percentage of no type of license
2.	Client copyright = percentage of proprietary license 
3.	Free license = percentage of public domain license
4.	Top 5 permissive license type 
= sum of number of files with permissive license type and take top 5 / sum of number of files * 100
5.	Top 3 copyleft weak 
= sum of number of files with copyleft weak license type and take top 3 / sum of number of files * 100
6.	Top 2 copyleft
= sum of number of files with copyleft license type and take top 2 / sum of number of files * 100
Finally, combine all category and percentage into node array to create node for Sankey
Create link array for connection between node
Therefore, the total number of node array and link array are 25.
Percentage of Audits with Copyleft Licenses
= number of audits with copyleft license type / total number of audits * 100
Percentage of Audits with Non-Commercial License
= number of audits with “no information license” or “client need review” / total number of audits * 100
Percentage of Audits with Commercial Components
= number of audits with commercial license / total number of audits *100
Average Number of OSS Packages Per Audit
= total number of OSS packages / total number of audits
Average Number of OSS Licenses Per Audit
= total number of OSS license / total number of audits
Average Number of CVE's Identified Per Audit
= total number of CVE’s identified / total number of audits
Top 10 OSS packages
List and Frequency = count frequency of OSS packages and sort by top 10 highest
Percentage = count unique package per audit / total number of audits
Top 10 OSS licenses
List and Frequency = count frequency of OSS licenses and sort by top 10 highest
Percentage = count unique licenses per audit / total number of audits
Software Model (all applications scanned)
Percentage of total files by software model
= group number of files for each software model type 
and divided each group by total number of files 
and * 100
Average percentage of files by software model
= sum of number of files for each audit by software model and then calculate average for each group
Software License Types (all applications scanned)
Percentage of total files by license type
= group number of files for each license type 
and divided each group by total number of files 
and * 100
Average percentage of files by license type
= sum of number of files for each audit by license type and then calculate average for each group
Vulnerabilities tab
Most Frequent CVE Score Identified Per Audit
= count the most CVE score was occurred
Most Frequent Severity Level of a CVE Identified Per Audit
= count the most severity level of a CVE was occurred
Average Age of CVE's Identified Per Audit
= Average of (Report date – created date of CVE)
Percentage of Packages with Reported CVE's
Packages with reported CVE’s = count package containing CVE / total number of packages * 100
Packages without reported CVE's = 100 - Packages with reported CVE's
Top 10 Packages with CVE Severity 8 or Greater
= count number of CVE if CVE score > 7 for each package and take only top 10 of the list
