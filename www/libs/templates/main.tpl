{*подключаем шапку шаблона*}
{$header}
{$action = $arResult->ACTION}
{$pos1 = $arResult->POS1}
{$two_class = "" }
<!--wrap-->
<div id="wrap" >
    {if ($action eq 'services' || $action eq 'nashi_raboty') && $pos1!= ''}
        {$two_class = "two-columns" }
    {/if}
    <div class="container {$two_class}">
        {if $action eq 'MainPage'}
            {$content}
        {elseif ($action eq 'services' || $action eq 'nashi_raboty') && $pos1!= ''}
            <div class="row">
                <div class="col-xs-3">
                    {$left_menu}
                </div>
                <div class="col-xs-9">
                    <div class="jumbotron" role="main" id="content-page" >
                        {$edit}
                        {$bread_crumbs}
                        <h1 class="page-title">{$title_main}</h1>
                        {$content}
                        <div class="pusher"></div>
                    </div>
                </div>
            </div>
        {else}
        <div class="row">
            <div class="col-xs-12">
                <div class="jumbotron" role="main" id="content-page">
                    {$edit}
                    {$bread_crumbs}
                    <h1 class="page-title">{$title_main}</h1>
                    {$content}
                </div>
            </div>
        </div>
        {/if}
        {if $action eq 'catalog'}
            {$catalog_menu}
        {/if}
    </div>
    {if $action eq 'admin-panel'}
        {$login_form}
    {/if}
</div>
<!--/wrap-->
{$calc}
{$backcall}
{$response}
{*подключаем футер шаблона*}
{$footer}


