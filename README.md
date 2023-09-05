# Browser Extension Support Module
by Paige Julianne Sullivan, Johns Hopkins Bloomberg School of Public Health - 
METRC [psullivan@jhu.edu](mailto:psullivan@jhu.edu).  

Copyright (c) 2023 The Johns Hopkins University.  

Licensed under the MIT License.  See [LICENSE](LICENSE) for details.


## Description
This module provides support for the browser extension that's freely available
on the browser marketplaces for Chrome, Firefox, Edge, and Opera.

## Installation and Use - READ THIS FIRST
1. ___FOR SECURITY___ create a new empty project.  This project will be used to grant
access to certain users on your system.  I recommend naming it something like
"Browser Extension Support - DO NOT DELETE" or something similar.
2. Download this module by downloading through the REDCap Consortium
    or by downloading the code from GitHub and uploading it to your REDCap server.
3. After downloading the module, enable it in the Control Center.
4. Enable the module on the new project you created in step 0. 
5. Go to the project and start adding your users.  The only access they need is
    "API Export".  You can add them to the project
    in any way you want, but I recommend using the "Add / Edit Users" button on
    the project home page if you want to run a pilot project first.
6. Once the users have been created, generate API keys for all of them by going
    to the "Manage API Keys" page and clicking "Generate API Key" for each user.
7. Once the API keys have been generated, go to the "Browser Extension Support" page
that is now under "External Modules" on the left-hand menu. 
8. Copy the link to this page and pass it out to your users.  They can then follow the
instructions on that page to install the extension and get started.
9. ___NOTE___:  If you are masquerading as a user (using the "View As User") 
option dropdown, the configuration key will be set for the user you actually
are logged in as, __not__ the user you are masquerading as.  This is a limitation
of REDCap.  If you want to test the extension as a user, you will need to log in
as that user.  If you want to test the extension as an administrator, you will
need to log in as an administrator.  You can't do both at the same time.  Otherwise
the configuration key will be set for the user you are logged in as, not the user
you are masquerading as.

## A Note About API Keys
It is true that in this way, API keys ___could___ be stolen and used to access
data in your project.  This is why I ___highly recommend___ that you create a new
project for this module.  If the API key is stolen, they will only be able to
export data in the project that you created for this module (which, should
remain empty).

The way I use the API key is to only authenticate the user to return a list
of projects they have access to.  Again, even if the API key is stolen and
only a list of projects the user has access to and nothing else.

If you believe an API key has been stolen, you are welcome to regenerate
it in the project.  However, the user will need to reconfigure the extension
with their new configuration key.

This extension is open source, so you are welcome to look at the code and
see how it works.  If you have any questions, please feel free to contact
me at [psullivan@jhu.edu](mailto:psullivan@jhu.edu).

## Repositories and Downloads
* GitHub for this module:  https://github.com/metrc/redcap-browser-extension-support
* GitHub for the browser extension:  https://github.com/metrc/redcap_browser_extension
* Chrome/Edge/Opera extension: https://chrome.google.com/webstore/detail/redcap-browser-extension/gplbopmpolkcfokdhjeclihfhnlhleji
* Firefox extension: https://addons.mozilla.org/en-US/firefox/addon/redcap-browser-extension
