# The Open Source Software Dashboard project 
is a summary of Open Source Software analysis including top 10 licenses, top 10 packages, top 10 high severity packages, average age of Vulnerabilities and Exposures (CVE), etc. The dashboard provides the big picture to our clients, and their awareness of severity of their code. 
**The dashboard is written in LAMP with Laravel 5.4 framework.

<h1>OSS Dashboard Calculation</h1>
<h3>Summary tab</h3>
<h5>Percentage of Audits containing Open Source Software (OSS)</h5>
<p>Percentage of Audits with OSS = Number of audits containing OSS/ total number of audits * 100</p>
<p>Percentage of Audit without OSS = 100 - Percentage of Audits with OSS</p>
<h5>Sankey chart structure</h5>
<p>Total number of files -> divided by software model -> license type -> license base</p>
<p>Percentage of Total number of files = 100</p>
<p>Percentage of Files per Software model </p>
<p>= sum of number of files for each software model / sum of number of files * 100</p>
<p>Percentage of Files per license type </p>
<p>= sum of number of files for each license type/ sum of number of files * 100</p>
<p>Percentage of license base including</p>
<p>1.	No license information = percentage of no type of license</p>
<p>2.	Client copyright = percentage of proprietary license </p>
<p>3.	Free license = percentage of public domain license </p>
<p>4.	Top 5 permissive license type </p>
<p>= sum of number of files with permissive license type and take top 5 / sum of number of files * 100</p>
<p>5.	Top 3 copyleft weak </p>
<p>= sum of number of files with copyleft weak license type and take top 3 / sum of number of files * 100</p>
<p>6.	Top 2 copyleft </p>
<p>= sum of number of files with copyleft license type and take top 2 / sum of number of files * 100 </p>
<p>Finally, combine all category and percentage into node array to create node for Sankey </p>
<p>Create link array for connection between node </p>
<p>Therefore, the total number of node array and link array are 25. </p>
<h5>Percentage of Audits with Copyleft Licenses </h5>
<p>= number of audits with copyleft license type / total number of audits * 100 </p>
<h5>Percentage of Audits with Non-Commercial License </h5>
<p>= number of audits with “no information license” or “client need review” / total number of audits * 100 </p>
<h5>Percentage of Audits with Commercial Components </h5>
<p>= number of audits with commercial license / total number of audits *100</p>
<h5>Average Number of OSS Packages Per Audit </h5>
<p>= total number of OSS packages / total number of audits </p>
<h5>Average Number of OSS Licenses Per Audit </h5>
<p>= total number of OSS license / total number of audits </p>
<h5>Average Number of CVE's Identified Per Audit </h5>
<p>= total number of CVE’s identified / total number of audits </p>
  
<h3>Top 10 OSS packages </h3>
<p>List and Frequency = count frequency of OSS packages and sort by top 10 highest</p>
<p>Percentage = count unique package per audit / total number of audits</p>
  
<h3>Top 10 OSS licenses </h3>
<p>List and Frequency = count frequency of OSS licenses and sort by top 10 highest </p>
<p>Percentage = count unique licenses per audit / total number of audits </p>
  
<h3>Software Model (all applications scanned) </h3>
<h5>Percentage of total files by software model </h5>
<p>= group number of files for each software model type </p>
<p>and divided each group by total number of files </p>
<p>and * 100</p>
<h5>Average percentage of files by software model</h5>
<p>= sum of number of files for each audit by software model and then calculate average for each group</p>
  
<h3>Software License Types (all applications scanned) </h3>
<h5>Percentage of total files by license type </h5>
<p>= group number of files for each license type </p>
<p>and divided each group by total number of files </p>
<p>and * 100</p>
<h5>Average percentage of files by license type</h5>
<p>= sum of number of files for each audit by license type and then calculate average for each group</p>
  
<h3>Vulnerabilities tab</h3>
<h5>Most Frequent CVE Score Identified Per Audit</h5>
<p>= count the most CVE score was occurred</p>
<h5>Most Frequent Severity Level of a CVE Identified Per Audit</h5>
<p>= count the most severity level of a CVE was occurred</p>
<h5>Average Age of CVE's Identified Per Audit</h5>
<p>= Average of (Report date – created date of CVE)</p>
<h5>Percentage of Packages with Reported CVE's</h5>
<p>Packages with reported CVE’s = count package containing CVE / total number of packages * 100</p>
<p>Packages without reported CVE's = 100 - Packages with reported CVE's</p>
<h5>Top 10 Packages with CVE Severity 8 or Greater</h5>
<p>= count number of CVE if CVE score > 7 for each package and take only top 10 of the list</p>
