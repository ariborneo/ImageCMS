<div class="d_n">{if $category['cat_id']}{$categoryId=$category['cat_id']}{else:}{$categoryId = $categoryDef['id']}{/if}</div>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Edit metadata for category','mod_seoexpert')} {echo  $category['settings']['categoryNameTMP']}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$ADMIN_URL}/admin/components/init_window/mod_seoexpert/productsCategories" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back','mod_seoexpert')}</span></a>
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit submitButton" data-form="#createDiscountForm" data-submit>
                    <i class="icon-ok icon-white"></i>{lang('Save','mod_seoexpert')}
                </button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#createDiscountForm" data-action="close">
                    <i class="icon-check"></i>
                    {lang('Save and exit', 'admin')}
                </button>
                {echo create_language_select($languages, $locale, "/admin/components/init_window/mod_seoexpert/productCategoryEdit/".$categoryId)}
            </div>
        </div>
    </div>
    <form method="post" action="/admin/components/init_window/mod_seoexpert/productCategoryEdit/{$categoryId}/{$locale}" enctype="multipart/form-data" id="createDiscountForm">
        <table class="table table-striped table-bordered table-condensed content_big_td module-cheep">
            <thead><tr><th colspan="6"><br/></th></tr></thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd discount-out">
                            <div class="form-horizontal">
                                <input id="autocomleteCategory" type="hidden" 
                                       autocomplete="off" 
                                       name='categoryNameTMP' 
                                       readonly="readonly"
                                       value="{if $category['settings']['categoryNameTMP']}{$category['settings']['categoryNameTMP']}{else:}{$categoryDef['name']}{/if}" />
                                <input id="autocomleteCategoryId" type="hidden" 
                                       name='category_id' 
                                       value="{$categoryId}" />
                                <label class="">
                                    <span class="span4">
                                        <span data-title="Variables, can use to:" class="popover_ref" data-original-title="">
                                            <i class="icon-info-sign"></i>
                                        </span>
                                        <div class="d_n">
                                            <b>%ID%</b> - ID <br/>
                                            <b>%name%</b> - {lang('Product name','mod_seoexpert')}<br/>
                                            <b>%category%</b> - {lang('Category, which is assigned to the product','mod_seoexpert')}<br/>
                                            <b>%brand%</b> - {lang('Brand, which is assigned to the product','mod_seoexpert')}<br/>
                                            <b>%price%</b> - {lang('Product price','mod_seoexpert')}<br/>
                                            <b>%CS%</b> - {lang('Main currency','mod_seoexpert')}<br/>
                                            <b>%p_xxxx%</b> - {lang('Displays the value of the property, instead of xxxx - id properties','mod_seoexpert')}<br/>
                                        </div>
                                        Meta-title:
                                    </span>
                                    <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplate' value="{$category['settings']['productTemplate']}" /></span>
                                </label>
                                <label class="">
                                    <span class="span4">
                                        <span data-title="Variables, can use to:" class="popover_ref" data-original-title="">
                                            <i class="icon-info-sign"></i>
                                        </span>
                                        <div class="d_n">
                                            <b>%ID%</b> - {lang('Product ID','mod_seoexpert')} <br/>
                                            <b>%name%</b> - {lang('Product name','mod_seoexpert')}<br/>
                                            <b>%desc%</b> - {lang('Product description','mod_seoexpert')}<br/>
                                            <b>%category%</b> - {lang('Category, which is assigned to the product','mod_seoexpert')}<br/>
                                            <b>%brand%</b> - {lang('Brand, which is assigned to the product','mod_seoexpert')}<br/>
                                            <b>%price%</b> - {lang('Product price','mod_seoexpert')}<br/>
                                            <b>%CS%</b> - {lang('Main currency','mod_seoexpert')}<br/>
                                            <b>%p_xxxx%</b> - {lang('Displays the value of the property, instead of xxxx - id properties','mod_seoexpert')}<br/>
                                        </div>
                                        Meta-description:
                                    </span>
                                    <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplateDesc' value="{$category['settings']['productTemplateDesc']}" /></span>
                                </label>

                                <label class="">
                                    <span class="span4">
                                        {lang('Description length','mod_seoexpert')}:
                                    </span>
                                    <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplateDescCount' value="{$category['settings']['productTemplateDescCount']}" /></span>
                                </label>

                                <label class="">
                                    <span class="span4">
                                        <span data-title="Переменные, которые можно использовать:" class="popover_ref" data-original-title="">
                                            <i class="icon-info-sign"></i>
                                        </span>
                                        <div class="d_n">
                                            <b>%name%</b> - {lang('Product name','mod_seoexpert')}<br/>
                                            <b>%category%</b> - {lang('Category, which is assigned to the product','mod_seoexpert')}<br/>
                                            <b>%brand%</b> - {lang('Brand, which is assigned to the product','mod_seoexpert')}<br/>
                                            <b>%p_xxxx%</b> - {lang('Displays the value of the property, instead of xxxx - id properties','mod_seoexpert')}<br/>
                                        </div>
                                        Meta-keywords:
                                    </span>
                                    <span class="span8 discount-name"><input type="text" autocomplete="off" name='productTemplateKey' value="{$category['settings']['productTemplateKey']}" /></span>
                                </label>

                                <div>
                                    <div class="frame_label no_connection">
                                        <span class="span4">{lang('Active','mod_seoexpert')}:</span>
                                        <span class="span1">
                                            <span class="niceCheck b_n">
                                                <input name="useProductPattern"  {if $category['active'] == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <div class="frame_label no_connection">
                                        <span class="span4">{lang('Use only for empty metadata','mod_seoexpert')}:</span>
                                        <span class="span1">
                                            <span class="niceCheck b_n">
                                                <input name="useProductPatternForEmptyMeta"  {if $category['empty_meta'] == 1} checked="checked" {/if}value="1" type="checkbox"/>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section>