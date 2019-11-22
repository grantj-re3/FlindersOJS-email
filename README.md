# FlindersOJS-email

## Purpose

Allow OJS v3 email to comply with *SMTP AUTH client submission* such
as offerred by Microsoft Office 365.


## Introduction

If your organisation uses Microsoft Office 365 (or similar) for
its hosted email infrastructure and if your organisation also
has an externally hosted OJS (version 3) instance, then this
solution may be useful for you.

This solution allows email from your hosted OJS instance to be
sent via your Office 365 email infrastructure and hence has
the advantage that Sender Policy Framework (SPF) and DomainKeys
Identified Mail (DKIM) for your existing domain will not need
to be updated. The destination email addresses maybe internal
to your organisation or external.

The requirements for *SMTP AUTH client submission* are:

1. Network traffic encryption (e.g. TLS) between OJS (the email
   sender) and the SMTP gateway
2. SMTP authenication (i.e. username and password, where the
   username is typically an email address) for the SMTP gateway
3. The email FROM address must match a pre-configured email
   address (typically the username-email-address used in
   the SMTP authenication or an alias of it)

These requirements should minimise the risk of your SMTP
gateway being used as an open mail relay.

OJS already supports encryption and SMTP authenication (i.e.
items 1 and 2 above) but currently does not support the
configuration of a FROM address. The source code changes in
this repository permit this new feature.


## Configuration

Please see below an example of how to configure config.inc.php
(a template and excerpt are provided within this repository).

Items 1 and 2 above can be configured with the existing OJS
app settings for:

- smtp
- smtp_server
- smtp_port
- smtp_auth
- smtp_username
- smtp_password

Item 3 above can be configured with the ***new*** OJS app settings for:

- forced_from_address
- forced_from_name

provided you update Mail.inc.php with the changes in this repository.

Note that *forced_from_name* is not a requirement to get *SMTP AUTH
client submission* operating. However without it email recipients may
get confused when the REPLY-TO address does not match the FROM address.
Hence *forced_from_name* is an attempt to get OJS sent email to behave
in a similar way to mailing-list sent email. That is, most email
clients will display received email as from "Mr Joe Bloggs via My OJS
Journal" or "Ms Jane Doe via My OJS Journal".

```
[email]

; Use SMTP for sending mail instead of mail()
smtp = On

; SMTP server settings
smtp_server = smtp.office365.com
smtp_port = 587

; Enable SMTP authentication
; Supported mechanisms: ssl, tls
smtp_auth = tls
smtp_username = username
smtp_password = password

; Allow envelope sender to be specified
; (may not be possible with some server configurations)
; allow_envelope_sender = Off

; Default envelope sender to use if none is specified elsewhere
; default_envelope_sender = my_address@my_host.com

; Force the default envelope sender (if present)
; This is useful if setting up a site-wide no-reply address
; The reply-to field will be set with the reply-to or from address.
; force_default_envelope_sender = Off

; CUSTOMISATION (Requires a change to Mail.inc.php)
; Force the FROM-address to be the address specified below.
forced_from_address = my_from_address@example.com

; CUSTOMISATION (Requires a change to Mail.inc.php)
; If forced_from_address is uncommented above, then the FROM-address
; will not usually match the OJS user who sent the email
; (who will be the REPLY-TO user). This field allows you to
; give a name to the FROM-address user which is combined with the
; name of the sending user. E.g. If forced_from_name is "My Journal"
; and the user who triggers the email is Mr Joe Bloggs, then the
; FROM-name will be "Mr Joe Bloggs via My Journal"
forced_from_name = "My Journal"
```


## Gotchas

- Some email systems ignore the supplied FROM-name and insist on using
their own (eg. when they can lookup the FROM-name because the
FROM-address is within their own domain; or Google Mail who often
supply a FROM-name even if not within their own domain!).


## References

OJS3 email administration is documented at
https://docs.pkp.sfu.ca/admin-guide/en/email

The original source code for Open Journal Systems (OJS) can be found at:

- https://github.com/pkp/ojs
- https://github.com/pkp/pkp-lib
- OJS 3.1.2 Mail delivery code is available at https://github.com/pkp/pkp-lib/blob/stable-3_1_2/classes/mail/Mail.inc.php

Microsoft Office 365 SMTP AUTH client submission is documented as
Option 1 at
https://docs.microsoft.com/en-us/exchange/mail-flow-best-practices/how-to-set-up-a-multifunction-device-or-application-to-send-email-using-office-3

