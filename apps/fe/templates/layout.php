<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head profile="http://www.w3.org/2005/10/profile">
    <?php if ($this->getContext()->getRequest()->getHost() == 'parlamento.openpolis.it'): ?>    
      <meta name="verify-v1" content="NkhveoVfinSZhsdVK8a+kN89DuYfXmo4BDwljNkry2M=" />
    <?php endif ?>

    <?php include_http_metas() ?>
    <?php include_metas() ?>

    <!-- Force title to our brand -->
    <title>PAI_opengov · JELU Consulting</title>

    <!-- Inject JELU brand stylesheet override -->
    <?php use_stylesheet('jelu.css') ?>

    <?php include_partial('global/social_metas') ?>

    <?php
    // CANONICAL for _old-s 
    $router = sfRouting::getInstance();
    $currentRouteName = $router->getCurrentRouteName();
    if ( preg_match("/^(.+)_old$/", $currentRouteName, $uriParts ) )
    {
      if ( has_slot('canonical_link') )
      {
        include_slot('canonical_link');
      }
      else
      {
        $newRouteURI = $uriParts[1];
        if ( $router->hasRouteName($newRouteURI) )
        {
          $currentParams = $this->getContext()->getRequest()->extractParameters(array('sort','page','type', 'id', 'slug', 'ramo'));
          echo '<link rel="canonical" href="'.rtrim($this->getContext()->getController()->genUrl('',true),'/'). $router->generate($newRouteURI, $currentParams)   .'" />';
        }
      }
    }
    ?>

    <!-- Favicon can later become a JELU icon -->
    <link rel="icon" type="image/gif" href="/ico_op_32x32.gif" />
  </head>

  <body>
    <div id="wrapper">

      <div id="header" style="background-color:#0A1E33; color:#fff; padding:10px 15px;">
        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;">

          <!-- LEFT: Logo + name -->
          <div id="brand" style="display:flex; align-items:center; gap:10px; font-family:-apple-system, BlinkMacSystemFont, 'Inter', sans-serif;">
            <!-- Replace this src later with your JELU logo path once we upload it -->
            <img src="/images/jelu-logo.png" alt="PAI_opengov · JELU Consulting" style="height:40px; width:auto; object-fit:contain;"/>

            <div style="line-height:1.2; color:#fff;">
              <div style="font-weight:600; font-size:15px;">PAI_opengov</div>
              <div style="font-size:12px; opacity:0.8;">JELU Consulting · Parliamentary AI Intelligence</div>
            </div>
          </div>

          <!-- RIGHT: tools -->
          <div id="tools" class="float-container" style="color:#fff;">
            <?php include_partial('global/tools') ?>	  
          </div>
        </div>

        <!-- NAVIGATION BAR -->
        <div id="navigation" style="margin-top:10px; background-color:#0A1E33; border-top:1px solid rgba(255,255,255,0.1); border-bottom:1px solid rgba(255,255,255,0.1); padding:8px 0;">
          <?php include_partial('global/navigation') ?> 
        </div>

        <?php if ($this->getContext()->getModuleName()!='default' || $this->getContext()->getActionName()!='index') include_partial('global/breadcrumbs') ?>

        <!-- REMOVE OLD OPENPOLIS DONATION BANNER 
             (we don't show "diventa socio openpolis") -->

        <!-- If you ever want to put a JELU banner here, do it instead of the old one -->
        <div style="text-align:center; padding-top:8px; padding-bottom:8px; background-color:#D2AF6B; color:#1b1b1b; font-size:12px; font-family:-apple-system,BlinkMacSystemFont,'Inter',sans-serif;">
          <strong>PAI_opengov</strong> · Dati parlamentari in chiaro per analisi strategica.
        </div>

      </div> <!-- /header -->

      <!-- MAIN CONTENT -->
      <div id="content-wrapper" style="padding:20px; background:#fff; color:#0A1E33; font-family:-apple-system,BlinkMacSystemFont,'Inter',sans-serif;">
        <?php echo $sf_data->getRaw('sf_content') ?>
      </div>

      <!-- FOOTER -->
      <div style="background-color:#0A1E33; color:#fff; padding:20px; font-size:12px; font-family:-apple-system,BlinkMacSystemFont,'Inter',sans-serif;">
        <div style="text-align:center; line-height:1.4;">
          PAI_opengov · JELU Consulting<br/>
          Real-time legislative intelligence platform for the Italian Parliament.
        </div>

        <?php include_partial('global/footer') ?>
      </div>

    </div> <!-- /wrapper -->

    <?php if ($this->getContext()->getRequest()->getHost() == 'parlamento18.bis.openpolis.it'): ?>    
      <?php include_partial('global/googleAnalytics') ?>	  
    <?php endif ?>

    <script type="text/javascript">
      // tiny fix: kill the old rotating Openpolis ad imgs
      // (but keep function structure, in case other code expects it)
      jQuery().ready(function(){
        function rImage() {
          // do nothing, we removed ad frames
        };
        rImage();        
      });
    </script>

  </body>
</html>
