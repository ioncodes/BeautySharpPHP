# BeautySharpPHP

## Purpose

[WIP] BeautySharpPHP allows you to instantly share your code with your team or anyone else. Another feature is the built-in syntax highlighting.
 Currently supports only C#-Snippets. Future version will include any major programming language.
 
## How it works

Just download the VSIX Visual Studio extension and install it. You will be able to use it right away. In order to paste the snippet, just click "Paste to B#" in your "Tools"/"Extras" menu.
A link will be copied to your clipboard, ready to be pasted anywhere.

## Documentation

### connect.php

Contains information about database credentials and type.
 This file needs to be included in every PHP file that needs direct access to the database.
 
### create.php
 
This file creates a new file on local server and writes the content passed by the POST request.

It accepts two params: 
```token``` and ```source```

Both of them are strings, however, first one is being generated by the Visual Studio plugin directly.

### createtoken.php

This file takes a unique GUID generated by the Visual Studio plugin and generates its SHA1 hash.
It then stores the unique identifier on local database in order to be able to write to a file being created later on within create.php and content written to it.

### index.php

This file prints the formatted and highlighted code. It accepts the token of the saved file as a param and prints the respective paste.

### getpastes.php

Displays all pastes associated with the passed token.