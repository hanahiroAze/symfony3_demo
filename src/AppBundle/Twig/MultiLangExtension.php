<?php
/**
 * Created by PhpStorm.
 * User: hanai
 * Date: 2016/11/26
 * Time: 19:39
 */

namespace AppBundle\Twig;


class MultiLangExtension extends \Twig_Extension
{
    private $translator;
    private $subLocale;

    public function __construct($translator, $subLocale = null)
    {
        $this->translator = $translator;
        $this->subLocale = $subLocale;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('mlang', array($this, 'multiTrans')),
        );
    }

    public function multiTrans($message, array $arguments = array(), $domain = null, $locale = null, $subLocale = null)
    {
        $str = "";
        $str .= $this->translator->trans($message, $arguments, $domain, $locale);
        $str .= "\n";
        $str .=  $this->translator->trans($message, $arguments, $domain, !empty($subLocale) ? $subLocale : $this->subLocale);
        return $str;
    }

    public function getName()
    {
        return 'multi_lang_extension';
    }
}