<?php if($this->countModules('toolbar')) : ?>
<div id="navigation" class="navbar navbar-inverse">
<?php if($responsive=="yes") {?>
<span class="navigation">Menu</span>
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#toolbar">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<?php } ?>
<div id="toolbar" class="navbar-collapse collapse">
<jdoc:include type="modules" name="toolbar" style="none" />
</div>
</div>
<?php endif; ?>