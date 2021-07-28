<?php

class ArticleListCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/index']);
    }

    public function openSiteIndex(\FunctionalTester $I)
    {
        $I->see('About', 'h2');        
    }

   
}
