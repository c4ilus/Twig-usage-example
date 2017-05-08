<?php

class MyExtension extends Twig_Extension
{
  public function getFilters()
  {
    return array(
      new Twig_SimpleFilter('markdown', array($this, 'markdownParse'), array('is_safe' => array('html')))
    );
  }

  public function getFunctions()
  {
    return array(
      new Twig_SimpleFunction('activeClass', array($this, 'activeClass'), array('needs_context' => TRUE))
    );
  }

  public function markdownParse($value)
  {
    return \Michelf\MarkdownExtra::defaultTransform($value);
  }

  public function activeClass(array $context, $page)
  {
    if (isset($context['current_page']) && $context['current_page'] === $page) {
      return 'active';
    }
  }
}