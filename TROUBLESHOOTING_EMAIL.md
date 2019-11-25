# Troubleshooting SMTP email over an encrypted channel


## Introduction

It is well documented that you can test/troubleshoot unencrypted SMTP
using a telnet client. However, did you know that you can perform a
similar test of SMTP over a TLS/SSL encrypted channel using openssl?
The example below worked for me on a Linux operating system.


## Prerequisite

This example assumes SMTP authentication is used. SMTP authentication
requires the username and password be Base64 encoded. I recommend
you avoid entering such secure information into a public web site.
Instead, you should be able to encode the username and password using
the Linux command line if the base64 app is installed. For example, type:

```
echo -en "SMTP_USERNAME" |base64
echo -en "SMTP_PASSWORD" |base64
```

The output of these commands are refered to as BASE64_SMTP_USERNAME
and BASE64_SMTP_PASSWORD respectively in the example below.


## Example

The information below shows what to type at the client end (and omits
the email server response).


Start openssl from the Linux command line.

- smtp.example.com is the name of the SMTP gateway.
- 587 is the TLS port at the SMTP gateway.
- The dollar symbol is a prompt so should not be typed.

```
$ openssl s_client -starttls smtp -crlf -connect smtp.example.com:587
```

Within the openssl interactive (telnet-like) session, type the following.
- Change host.example1.com, BASE64_SMTP_USERNAME, BASE64_SMTP_PASSWORD,
  sender@example1.com, recipient@example2.com, subject text and body
  text to suit your environment.
- Note that the blank line after the subject text and before the body
  text is important.
- Note that the blank line after the body text and before the period
  (i.e. full-stop) is important.

```
ehlo host.example1.com
auth login
BASE64_SMTP_USERNAME
BASE64_SMTP_PASSWORD
mail from:sender@example1.com
rcpt to:recipient@example2.com
data
Subject: Test 1a

This is a test

.
```


## References

***WARNING:*** In the reference below, it is suggested that a *Base64
converter* web site be used to convert the username and password to
Base64 encoding. Entering such information into a public web site is
a security risk so should be avoided. See above for an alternative
method.

- https://support.sugarcrm.com/Knowledge_Base/Email/Testing_Outbound_Email_Using_Command_Line/#SMTP_with_TLSSSL

