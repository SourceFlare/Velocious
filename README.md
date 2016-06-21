# Velocious
Fast/Barebones Closure-Based RESTful Framework.  This framework is so lightweight that it doesn't even come with an ORM, Security Classes, or other Helpers; it comprises of a router, mime type detector, and a dispatcher - that is it.

Velocious is by it's nature designed to offer up streamlined APIs and small operations such as logging, or sending an email, where having a full-blown MVC framework is not required.

### NGiNX Installation
You will need to re-write your urls using NGiNX's rewrite syntax, like so :-

      location / {
        rewrite ^(.*)$   Velocious.php?url=$1  last;
      }

### Compatability
Velocious has been written specifically for PHP 7.0 and above.
