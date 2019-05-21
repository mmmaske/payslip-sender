# Systemantech Payslip Sender

A small program to consecutively send payslips using an uploaded CSV file.

# Process

* User - the user or administrator in charge of all the payslip and reference files
* Recipient - the person who will be receiving the payslip file, identified by their email address
* System - an automated program which will perform the repetitive task of sending payslips according to the data provided by the user

1. Upload payslips - the user should upload payslips in the payslip file management module. The system will create a catalog in the database and assign attributes (whether or not the file has been sent)
2. Upload reference file - the reference file contains the list of email addresses their corresponding filenames. Upon reading this file, the system will cross reference the recipients with their payslip file and display whether or not sending will be possible
3. Schedule sending - the user should define when the system will perform sending of the payslip file to the recipient

# Reference file format

This section defines the format of the reference file. The columns are as follows:

1. Number (unused; the system does not care what is in this column)
2. Code (Employee code. unused; the system does not care what is in this column)
3. Formal Name (Recipient's full name. unused; the system does not care what is in this column)
4. Email Address (Important! This is the recipient. Without this, where will the email go?)
5. Filename (Important! This is the name of the payslip file. The system will attach this file to the email)
6, Active (unused; the system does not care what is in this column)

# Installing to a new server

## Via SSH (requires git)

1. Go to your webserver `cd /path/to/your/public/webserver`
2. Copy the program from the repository `git clone https://github.com/mmmaske/payslip-sender`
3. Copy the blank configuration file `cp blank-global-config.php global-config.php`
4. Edit the working configuration file `nano global-config.php`
