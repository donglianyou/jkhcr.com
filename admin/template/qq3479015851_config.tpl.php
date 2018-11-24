<?php include qq3479015851_tpl('inc_head');?>
<script type="text/javascript" src="js/vbm.js"></script>
<style>
.ccc2 ul input{margin:2px 0}
</style>
<div id="<?=SysGlbCfm_SOFTNAME?>" style=" padding-bottom:0">
    <div class="mpstopic-category">
        <div class="panel-tab">
            <ul class="clearfix tab-list">
                <?=get_qq3479015851_config_menu()?>
            </ul>
        </div>
    </div>
</div>
<form action="?part=update" method="post" name="form1">
<?=get_qq3479015851_config_input()?>
<div align="center" style="margin:15px;">
<input class="qq3479015851 mini" value="保存设置" type="submit" > 
<input type="button" onClick="history.back()"value="返回" class="qq3479015851 mini">
</div>
</form>
<?php qq3479015851_admin_tpl_global_foot();?>