Crevillo Ez5Oe CustomTags Bundle
================================

Crevillo Ez5Oe CustomTags Bundle is an eZ Publish 5 bundle for add EZ5 the ability of showing custom tags defined for eZ Online Editor.

This will help in the process of migrating sites to new Symfony stack

The bundle is currently in alpha state and stability is not guaranteed.

How it works
------------

The converter will look for "custom" tags in the xmlDoc string (aka data_text). For each of them, it will get its "name" attribute. This name
attribute will used to know which template will be in charge of showing the related content. 

This means that final users will need to create these templates and add them to the /Resources/views/ezoe/customtags folder

Example
-------

Suppose you had defined a youtube customtag in your content.ini.append.php like this

```php
<?php /*
[CustomTagSettings]
AvailableCustomTags[]=youtube

[youtube]
CustomAttributes[]
# Video code
CustomAttributes[]=codigo
# Width
CustomAttributes[]=ancho
# Height
CustomAttributes[]=alto

*/ ?>
```

To show the related content in the new symfony stack you will need two things:

* Provide a template called youtube.html.twig in the Resorcues/views/ezoe/customtags folder like [this](Crevillo/EzOeCustomTagBundle/Resources/views/ezoe/customtags/youtube.html.twig)
* Modify the [eZXml2Html5_custom.xsl] (Crevillo/EzOeCustomTagBundle/Core/FieldType/XmlText/Input/Resources/stylesheets/eZXml2Html5_custom.xsl) and add a transformation for every custom tag you may have

Installation
------------

Installation instructions will be added soon