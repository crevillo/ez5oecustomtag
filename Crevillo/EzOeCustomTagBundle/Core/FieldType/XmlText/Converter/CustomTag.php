<?php

namespace Crevillo\EzOeCustomTagBundle\Core\FieldType\XmlText\Converter;

use eZ\Publish\Core\FieldType\XmlText\Converter;
use Symfony\Component\Templating\EngineInterface;

use DOMDocument;

class CustomTag implements Converter
{
    /**
     * @var \Symfony\Component\Templating\EngineInterface
     */
    protected $templateEngine;
    
    public function __construct( EngineInterface $templateEngine )
    {
        $this->templateEngine = $templateEngine;
    }

    /**
     * Converts embed elements in $xmlDoc from internal representation to HTML5
     *
     * @param \DOMDocument $xmlDoc
     *
     * @return null
     */
    public function convert( DOMDocument $xmlDoc )
    {
        foreach ( $xmlDoc->getElementsByTagName( "custom" ) as $customTag )
        {
            if( !$customTag->hasAttribute( 'name' ) )
            {
                //throw
            }
            else
            {
                // get customTag Name
                $name = $customTag->getAttribute( 'name' );

                // loop over the attributes and pass them to the template
                $attributes = array();
                foreach ( $customTag->attributes as $attribute_name => $attribute_node )
                {
                    if( $attribute_name == 'name' )
                        continue;
                    $attributes[$attribute_name] = $attribute_node->nodeValue;
                }
                
                $renderedTag = $this->templateEngine->render(
                    'CrevilloEzOeCustomTagBundle:ezoe/customtags:' . $name . '.html.twig',
                    $attributes
                );
                
                $fragment = $xmlDoc->createDocumentFragment();
                $fragment->appendXml( $renderedTag );
            }

            $customTag->appendChild( $fragment );
        }
    }
}