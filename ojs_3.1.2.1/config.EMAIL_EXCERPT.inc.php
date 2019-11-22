;;;;;;;;;;;;;;;;;;
; Email Settings ;
;;;;;;;;;;;;;;;;;;

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

