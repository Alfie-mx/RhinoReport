<?php

namespace Earls\RhinoReportBundle\Templating\Generator;

/**
 * Earls\RhinoReportBundle\Templating\Generator\HtmlReportTemplateGenerator
 */
class HtmlReportTemplateGenerator extends HtmlTemplateGenerator
{

    protected $templatingService;

    public function __construct($templatingService, $templateTwig)
    {
        $this->templatingService = $templatingService;
        $this->template = $templateTwig;
    }

    public function getResponse($nameFile, $object, $arg)
    {
        $filterForm = $object->getItem('filter');
        $availableExport = $object->getAvailableExport();
        //if only one option, hidden field, need only the key
        if (count($availableExport) == 1) {
            $flipArray = array_flip($availableExport);
            $availableExport = array(array_shift($flipArray));
        }
        //$nameFile not used for html
        return $this->renderView($this->template, array_merge(array('filterForm' => $filterForm, 'availableExport' => $availableExport, 'js' => true, 'css' => true, 'url' => null), $arg));
    }

    protected function renderView($view, array $parameters = array())
    {
        return $this->templatingService->render($view, $parameters);
    }

}
