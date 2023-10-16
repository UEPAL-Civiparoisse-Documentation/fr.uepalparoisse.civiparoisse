<?php
//QUBE_IGNORE_FILE
use CRM_Civiparoisse_ExtensionUtil as E;

class CRM_Civiparoisse_Parametres_TemplateMailMosaico {

  const TITLE = "Modèle mail UEPAL";

  const BASE = "versafix-1";

  static function getTitle() : string
    {
      return self::TITLE;
    }

  static function getBase() : string
    {
      return self::BASE;
    }

  /**
   * Contenu JSON du Template
   * 
   * @var  string  $urlBase  URL de base de la base de donnée
   * @var  array  $content  Contenu JSON pour la création du Template
   * 
   * @return  array  $content  Contenu JSON pour la création du Template
   *
   */ 
  static function contentTemplateMosaico() {
    $urlBase = Civi::paths()->getVariable('cms.root', 'url');

    $content = "{\"type\":\"template\",\"customStyle\":false,\"preheaderVisible\":true,\"titleText\":\"[subject]\",\"preheaderBlock\":{\"type\":\"preheaderBlock\",\"customStyle\":true,\"id\":\"ko_preheaderBlock_1\",\"backgroundColor\":null,\"preheaderText\":\"\",\"linkStyle\":{\"type\":\"linkStyle\",\"face\":null,\"color\":null,\"size\":null,\"decoration\":null},\"preheaderLinkOption\":\"[unsubscribe_link]\",\"longTextStyle\":{\"type\":\"longTextStyle\",\"face\":null,\"color\":null,\"size\":null,\"linksColor\":null},\"unsubscribeText\":\"<br data-mce-bogus=\\\"1\\\">\",\"webversionText\":\"Visualiser dans votre navigateur\"},\"mainBlocks\":{\"type\":\"blocks\",\"blocks\":[{\"type\":\"imageBlock\",\"customStyle\":false,\"gutterVisible\":false,\"longTextStyle\":{\"type\":\"longTextStyle\",\"face\":null,\"color\":null,\"size\":null,\"linksColor\":null},\"id\":\"ko_imageBlock_2\",\"externalBackgroundColor\":null,\"backgroundColor\":null,\"image\":{\"type\":\"image\",\"src\":\"\",\"url\":\"\",\"alt\":\"\"}},{\"type\":\"hrBlock\",\"customStyle\":false,\"id\":\"ko_hrBlock_4\",\"externalBackgroundColor\":null,\"backgroundColor\":null,\"hrStyle\":{\"type\":\"hrStyle\",\"color\":null,\"hrWidth\":null,\"hrHeight\":null}},{\"type\":\"textBlock\",\"customStyle\":false,\"backgroundColor\":null,\"longTextStyle\":{\"type\":\"longTextStyle\",\"face\":null,\"color\":null,\"size\":null,\"linksColor\":null},\"longText\":\"<p></p><p>Saisir ici votre texte<br></p>\",\"id\":\"ko_textBlock_3\",\"externalBackgroundColor\":null},{\"type\":\"hrBlock\",\"customStyle\":false,\"id\":\"ko_hrBlock_2\",\"externalBackgroundColor\":null,\"backgroundColor\":null,\"hrStyle\":{\"type\":\"hrStyle\",\"color\":null,\"hrWidth\":null,\"hrHeight\":null}},{\"type\":\"sideArticleBlock\",\"customStyle\":true,\"backgroundColor\":\"#21a1d9\",\"titleVisible\":false,\"buttonVisible\":false,\"imageWidth\":\"166\",\"imagePos\":\"right\",\"titleTextStyle\":{\"type\":\"textStyle\",\"face\":null,\"color\":null,\"size\":null},\"longTextStyle\":{\"type\":\"longTextStyle\",\"face\":null,\"color\":null,\"size\":null,\"linksColor\":null},\"buttonStyle\":{\"type\":\"buttonStyle\",\"face\":null,\"color\":null,\"size\":null,\"buttonColor\":null,\"radius\":null},\"image\":{\"type\":\"image\",\"src\":\"\",\"url\":\"\",\"alt\":\"\"},\"longText\":\"<p><span style=\\\"color: rgb(255, 255, 255);\\\" data-mce-style=\\\"color: #ffffff;\\\"><strong>Paroisse protestante de XXXX</strong></span><br><span style=\\\"color: rgb(255, 255, 255);\\\" data-mce-style=\\\"color: #ffffff;\\\">Adresse et Ville</span></p><p><span style=\\\"color: rgb(255, 255, 255);\\\" data-mce-style=\\\"color: #ffffff;\\\">+33 3 88 xxxx - www.xxxxx</span></p>\",\"buttonLink\":{\"type\":\"link\",\"text\":\"BUTTON\",\"url\":\"\"},\"id\":\"ko_sideArticleBlock_4\",\"externalBackgroundColor\":null,\"titleText\":\"\\n                          Title\\n                          \"},{\"type\":\"socialBlock\",\"customStyle\":true,\"socialIconType\":\"colors\",\"fbVisible\":true,\"fbUrl\":\"\",\"twVisible\":true,\"twUrl\":\"\",\"ggVisible\":false,\"ggUrl\":\"\",\"webVisible\":true,\"webUrl\":\"\",\"inVisible\":false,\"inUrl\":\"\",\"flVisible\":false,\"flUrl\":\"\",\"viVisible\":false,\"viUrl\":\"\",\"instVisible\":true,\"instUrl\":\"\",\"youVisible\":true,\"youUrl\":\"\",\"longTextStyle\":{\"type\":\"longTextStyle\",\"face\":null,\"color\":null,\"size\":null,\"linksColor\":null},\"longText\":\"<p><br data-mce-bogus=\\\"1\\\"></p>\",\"backgroundColor\":null,\"id\":\"ko_socialBlock_1\"},{\"type\":\"textBlock\",\"customStyle\":true,\"backgroundColor\":null,\"longTextStyle\":{\"type\":\"longTextStyle\",\"face\":null,\"color\":null,\"size\":null,\"linksColor\":null},\"longText\":\"<p style=\\\"text-align: center;\\\" data-mce-style=\\\"text-align: center;\\\"><span style=\\\"color: rgb(51, 102, 255);\\\" data-mce-style=\\\"color: #3366ff;\\\"><span style=\\\"color: rgb(128, 128, 128);\\\" data-mce-style=\\\"color: #808080;\\\">Si vous ne souhaitez plus recevoir nos courriels, vous pouvez vous désabonner en cliquant sur le lien ci-après : <a href=\\\"{action.optOutUrl}\\\" data-mce-href=\\\"{action.optOutUrl}\\\" style=\\\"color: rgb(128, 128, 128);\\\" data-mce-style=\\\"color: #808080;\\\">Se désabonner</a></span><br></span></p>\",\"id\":\"ko_textBlock_2\",\"externalBackgroundColor\":null}]},\"theme\":{\"type\":\"theme\",\"frameTheme\":{\"type\":\"frameTheme\",\"backgroundColor\":\"#ffffff\",\"longTextStyle\":{\"type\":\"longTextStyle\",\"face\":\"Arial, Helvetica, sans-serif\",\"color\":\"#919191\",\"size\":\"13\",\"linksColor\":\"#cccccc\"},\"linkStyle\":{\"type\":\"linkStyle\",\"face\":\"Arial, Helvetica, sans-serif\",\"color\":\"#000000\",\"size\":\"13\",\"decoration\":\"underline\"}},\"contentTheme\":{\"type\":\"contentTheme\",\"longTextStyle\":{\"type\":\"longTextStyle\",\"face\":\"Arial, Helvetica, sans-serif\",\"color\":\"#3f3f3f\",\"size\":\"13\",\"linksColor\":\"#3f3f3f\"},\"externalBackgroundColor\":\"#ffffff\",\"externalTextStyle\":{\"type\":\"textStyle\",\"face\":\"Arial, Helvetica, sans-serif\",\"color\":\"#f3f3f3\",\"size\":\"18\"},\"backgroundColor\":\"#ffffff\",\"titleTextStyle\":{\"type\":\"textStyle\",\"face\":\"Arial, Helvetica, sans-serif\",\"color\":\"#3f3f3f\",\"size\":\"18\"},\"buttonStyle\":{\"type\":\"buttonStyle\",\"face\":\"Arial, Helvetica, sans-serif\",\"color\":\"#3f3f3f\",\"size\":\"13\",\"buttonColor\":\"#bfbfbf\",\"radius\":\"4\"},\"bigTitleStyle\":{\"type\":\"bigTitleStyle\",\"face\":\"Arial, Helvetica, sans-serif\",\"color\":\"#3f3f3f\",\"size\":\"22\",\"align\":\"center\"},\"hrStyle\":{\"type\":\"hrStyle\",\"color\":\"#0093d2\",\"hrWidth\":\"100\",\"hrHeight\":4},\"bigButtonStyle\":{\"type\":\"buttonStyle\",\"face\":\"Arial, Helvetica, sans-serif\",\"color\":\"#3f3f3f\",\"size\":\"11\",\"buttonColor\":\"#bfbfbf\",\"radius\":\"4\"}}}}";

    return $content;
  }

  /**
   * Métadonnées du Template
   * 
   * @var  string  $urlMetadata  URL complète du lien vers le template utilisé (Versafix)
   * @var  array  $metadata  Contenu Metadata pour la création du Template
   * 
   * @return  array  $metadata  Contenu Metadata pour la création du Template
   *
   */ 
  static function metadataTemplateMosaico() {
    $urlMetadata= Civi::resources()->getUrl('uk.co.vedaconsulting.mosaico','packages/mosaico/templates/versafix-1/template-versafix-1.html');
    $metadata =  "{\"template\":\"$urlMetadata\",\"name\":\"No name\",\"editorversion\":\"0.15.0\",\"templateversion\":\"1.0.5\"}";
    return $metadata;
  }

  /**
   * Contenu HTML du Template
   * 
   * @var  string  $urlBase  URL de base de la base de donnée
   * @var  array  $codeHTML  Code HTML pour la création du Template
   * 
   * @return  array  $codeHTML  Code HTML pour la création du Template
   *
   */ 
  static function htmlTemplateMosaico() {
    $urlBase = Civi::paths()->getVariable('cms.root', 'url');
    $urlVersafix=Civi::resources()->getUrl('uk.co.vedaconsulting.mosaico','packages/mosaico/templates/versafix-1/');

    $codeHtml = "
      <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
      <html xmlns=\"http://www.w3.org/1999/xhtml\">
      <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
        <meta name=\"viewport\" content=\"initial-scale=1.0\">
        <meta name=\"format-detection\" content=\"telephone=no\">
        <title>[subject]</title>
        <style type=\"text/css\">
          body{ Margin: 0; padding: 0; }
          img{ border: 0px; display: block; }

          .socialLinks{ font-size: 6px; }
          .socialLinks a{
            display: inline-block;
          }
          .socialIcon{
            display: inline-block;
            vertical-align: top;
            padding-bottom: 0px;
            border-radius: 100%;
          }
          .oldwebkit{ max-width: 570px; }
          td.vb-outer{ padding-left: 9px; padding-right: 9px; }
          table.vb-container, table.vb-row, table.vb-content{
            border-collapse: separate;
          }
          table.vb-row{
            border-spacing: 9px;
          }
          table.vb-row.halfpad{
            border-spacing: 0;
            padding-left: 9px;
            padding-right: 9px;
          }
          table.vb-row.fullwidth{
            border-spacing: 0;
            padding: 0;
          }
          table.vb-container{
            padding-left: 18px;
            padding-right: 18px;
          }
          table.vb-container.fullpad{
            border-spacing: 18px;
            padding-left: 0;
            padding-right: 0;
          }
          table.vb-container.halfpad{
            border-spacing: 9px;
            padding-left: 9px;
            padding-right: 9px;
          }
          table.vb-container.fullwidth{
            padding-left: 0;
            padding-right: 0;
          }
        </style>
        <style type=\"text/css\">
          /* yahoo, hotmail */
          .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{ line-height: 100%; }
          .yshortcuts a{ border-bottom: none !important; }
          .vb-outer{ min-width: 0 !important; }
          .RMsgBdy, .ExternalClass{
            width: 100%;
            background-color: #3f3f3f;
            background-color: #ffffff}

          /* outlook */
          table{ mso-table-rspace: 0pt; mso-table-lspace: 0pt; }
          #outlook a{ padding: 0; }
          img{ outline: none; text-decoration: none; border: none; -ms-interpolation-mode: bicubic; }
          a img{ border: none; }

          @media screen and (max-device-width: 600px), screen and (max-width: 600px) {
            table.vb-container, table.vb-row{
              width: 95% !important;
            }

            .mobile-hide{ display: none !important; }
            .mobile-textcenter{ text-align: center !important; }

            .mobile-full{
              float: none !important;
              width: 100% !important;
              max-width: none !important;
              padding-right: 0 !important;
              padding-left: 0 !important;
            }
            img.mobile-full{
              width: 100% !important;
              max-width: none !important;
              height: auto !important;
            }   
          }
        </style>
        <style type=\"text/css\">
          
          #ko_textBlock_3 .links-color a, #ko_textBlock_3 .links-color a:link, #ko_textBlock_3 .links-color a:visited, #ko_textBlock_3 .links-color a:hover{
            color: #3f3f3f;
            color: #3f3f3f;
            text-decoration: underline
          }
          
          #ko_textBlock_2 .links-color a, #ko_textBlock_2 .links-color a:link, #ko_textBlock_2 .links-color a:visited, #ko_textBlock_2 .links-color a:hover{
            color: #3f3f3f;
            color: #3f3f3f;
            text-decoration: underline
          }
           #ko_textBlock_3 .long-text p{ Margin: 1em 0px }  #ko_textBlock_2 .long-text p{ Margin: 1em 0px }  #ko_textBlock_3 .long-text p:last-child{ Margin-bottom: 0px }  #ko_textBlock_2 .long-text p:last-child{ Margin-bottom: 0px }  #ko_textBlock_3 .long-text p:first-child{ Margin-top: 0px }  #ko_textBlock_2 .long-text p:first-child{ Margin-top: 0px } 
          #ko_sideArticleBlock_4 .links-color a, #ko_sideArticleBlock_4 .links-color a:link, #ko_sideArticleBlock_4 .links-color a:visited, #ko_sideArticleBlock_4 .links-color a:hover{
            color: #3f3f3f;
            color: #3f3f3f;
            text-decoration: underline
          }
           #ko_sideArticleBlock_4 .long-text p{ Margin: 1em 0px }  #ko_sideArticleBlock_4 .long-text p:last-child{ Margin-bottom: 0px }  #ko_sideArticleBlock_4 .long-text p:first-child{ Margin-top: 0px } 
          #ko_socialBlock_1 .links-color a, #ko_socialBlock_1 .links-color a:link, #ko_socialBlock_1 .links-color a:visited, #ko_socialBlock_1 .links-color a:hover{
            color: #cccccc;
            color: #cccccc;
            text-decoration: underline
          }
           #ko_socialBlock_1 .long-text p{ Margin: 1em 0px }  #ko_socialBlock_1 .long-text p:last-child{ Margin-bottom: 0px }  #ko_socialBlock_1 .long-text p:first-child{ Margin-top: 0px } 
          #ko_imageBlock_2 a, #ko_imageBlock_2 a:link, #ko_imageBlock_2 a:visited, #ko_imageBlock_2 a:hover{
            color: #3f3f3f;
            color: #3f3f3f;
            text-decoration: underline
          }
          </style>
      </head>
      <body style=\"Margin: 0; padding: 0; background-color: #ffffff; color: #919191;\" vlink=\"#cccccc\" text=\"#919191\" bgcolor=\"#ffffff\" alink=\"#cccccc\">

        <center>

        <!-- preheaderBlock -->
        

        <table class=\"vb-outer\" style=\"background-color: #ffffff;\" id=\"ko_preheaderBlock_1\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
          <tbody><tr>
            <td class=\"vb-outer\" style=\"padding-left: 9px; padding-right: 9px; background-color: #ffffff;\" valign=\"top\" bgcolor=\"#ffffff\" align=\"center\">
              <div style=\"display: none; font-size: 1px; color: #333333; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;\"></div>

      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->
              <div class=\"oldwebkit\" style=\"max-width: 570px;\">
              <table class=\"vb-row halfpad\" style=\"border-collapse: separate; border-spacing: 0; padding-left: 9px; padding-right: 9px; width: 100%; max-width: 570px; background-color: #ffffff;\" width=\"570\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
                <tbody><tr>
                  <td style=\"font-size: 0; background-color: #ffffff;\" valign=\"top\" bgcolor=\"#ffffff\" align=\"center\">

      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"552\"><tr><![endif]-->
      <!--[if (gte mso 9)|(lte ie 8)]><td align=\"left\" valign=\"top\" width=\"276\"><![endif]--> 
      <div style=\"display: inline-block; max-width: 276px; vertical-align: top; width: 100%;\" class=\"mobile-full\"> 
                          <table class=\"vb-content\" style=\"border-collapse: separate; width: 100%;\" width=\"276\" cellspacing=\"9\" cellpadding=\"0\" border=\"0\" align=\"left\">
                            <tbody><tr>
                              <td style=\"font-weight: normal; text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #000000;\" width=\"100%\" valign=\"top\" align=\"left\">
                                <a style=\"text-decoration: underline; color: #000000;\" target=\"_new\" href=\"[unsubscribe_link]\"><br data-mce-bogus=\"1\"></a> 
                                
                              </td>
                            </tr>
                          </tbody></table>
      </div><!--[if (gte mso 9)|(lte ie 8)]>
      </td><td align=\"left\" valign=\"top\" width=\"276\">
      <![endif]--><div style=\"display: inline-block; max-width: 276px; vertical-align: top; width: 100%;\" class=\"mobile-full mobile-hide\"> 

                          <table class=\"vb-content\" style=\"border-collapse: separate; width: 100%; text-align: right;\" width=\"276\" cellspacing=\"9\" cellpadding=\"0\" border=\"0\" align=\"left\">
                            <tbody><tr>
                              <td style=\"font-weight: normal; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #000000;\" width=\"100%\" valign=\"top\">
                            <span style=\"color: #000000; text-decoration: underline;\">
                                <a href=\"[show_link]\" style=\"text-decoration: underline; color: #000000;\" target=\"_new\">Visualiser dans votre navigateur</a>
                               </span>
                             </td>
                            </tr>
                          </tbody></table>

      </div><!--[if (gte mso 9)|(lte ie 8)]>
      </td></tr></table><![endif]-->

                  </td>
                </tr>
              </tbody></table>
              </div>
      <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody></table>

        
        <!-- /preheaderBlock -->

        <table class=\"vb-outer\" style=\"background-color: #ffffff;\" id=\"ko_imageBlock_2\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
          <tbody><tr>
            <td class=\"vb-outer\" style=\"padding-left: 9px; padding-right: 9px;\" valign=\"top\" align=\"center\">

      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->
              <div class=\"oldwebkit\" style=\"max-width: 570px;\">
              <table class=\"vb-container fullwidth\" style=\"border-collapse: separate; padding-left: 0; padding-right: 0; width: 100%; max-width: 570px; background-color: #ffffff;\" width=\"570\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\" align=\"center\">
                <tbody><tr>
                  <td valign=\"top\" align=\"center\">
                    <img class=\"mobile-full\" alt=\"\" style=\"border: 0px; max-width: 570px; display: block; border-radius: 0px; width: 100%; height: auto; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;\" src=\"".$urlBase."civicrm/mosaico/img/placeholder?method=placeholder&amp;params=570%2C200\" width=\"570\" vspace=\"0\" hspace=\"0\" border=\"0\">
                  </td>
                </tr>
              </tbody></table>
              
              </div>
      <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody></table><table class=\"vb-outer\" style=\"background-color: #ffffff;\" id=\"ko_hrBlock_4\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
          <tbody><tr>
            <td class=\"vb-outer\" style=\"padding-left: 9px; padding-right: 9px; background-color: #ffffff;\" valign=\"top\" bgcolor=\"#ffffff\" align=\"center\">

      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->
              <div class=\"oldwebkit\" style=\"max-width: 570px;\">
              <table class=\"vb-container halfpad\" style=\"border-collapse: separate; border-spacing: 9px; padding-left: 9px; padding-right: 9px; width: 100%; max-width: 570px; background-color: #ffffff;\" width=\"570\" cellspacing=\"9\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
                <tbody><tr>
                  <td style=\"background-color: #ffffff;\" valign=\"top\" bgcolor=\"#ffffff\" align=\"center\">
                    <table style=\"width: 100%;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
                      <tbody><tr>
                        <td style=\"font-size: 1px; line-height: 4px; width: 100%; background-color: #0093d2;\" width=\"100%\" height=\"4\">&nbsp;</td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
              </div>
      <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody></table><table class=\"vb-outer\" style=\"background-color: #ffffff;\" id=\"ko_textBlock_3\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
          <tbody><tr>
            <td class=\"vb-outer\" style=\"padding-left: 9px; padding-right: 9px; background-color: #ffffff;\" valign=\"top\" bgcolor=\"#ffffff\" align=\"center\">

      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->
              <div class=\"oldwebkit\" style=\"max-width: 570px;\">
              <table class=\"vb-container fullpad\" style=\"border-collapse: separate; border-spacing: 18px; padding-left: 0; padding-right: 0; width: 100%; max-width: 570px; background-color: #ffffff;\" width=\"570\" cellspacing=\"18\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
                <tbody><tr>
                  <td class=\"long-text links-color\" style=\"text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;\" align=\"left\"><p style=\"Margin: 1em 0px; Margin-top: 0px;\"></p><p style=\"Margin: 1em 0px; Margin-bottom: 0px;\">Saisir ici votre texte<br></p></td>
                </tr>
              </tbody></table>
              </div>
      <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody></table><table class=\"vb-outer\" style=\"background-color: #ffffff;\" id=\"ko_hrBlock_2\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
          <tbody><tr>
            <td class=\"vb-outer\" style=\"padding-left: 9px; padding-right: 9px; background-color: #ffffff;\" valign=\"top\" bgcolor=\"#ffffff\" align=\"center\">

      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->
              <div class=\"oldwebkit\" style=\"max-width: 570px;\">
              <table class=\"vb-container halfpad\" style=\"border-collapse: separate; border-spacing: 9px; padding-left: 9px; padding-right: 9px; width: 100%; max-width: 570px; background-color: #ffffff;\" width=\"570\" cellspacing=\"9\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
                <tbody><tr>
                  <td style=\"background-color: #ffffff;\" valign=\"top\" bgcolor=\"#ffffff\" align=\"center\">
                    <table style=\"width: 100%;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
                      <tbody><tr>
                        <td style=\"font-size: 1px; line-height: 4px; width: 100%; background-color: #0093d2;\" width=\"100%\" height=\"4\">&nbsp;</td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
              </div>
      <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody></table><table class=\"vb-outer\" style=\"background-color: #ffffff;\" id=\"ko_sideArticleBlock_4\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
          <tbody><tr>
            <td class=\"vb-outer\" style=\"padding-left: 9px; padding-right: 9px; background-color: #ffffff;\" valign=\"top\" bgcolor=\"#ffffff\" align=\"center\">

      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->
              <div class=\"oldwebkit\" style=\"max-width: 570px;\">
              <table class=\"vb-row fullpad\" style=\"border-collapse: separate; border-spacing: 9px; width: 100%; max-width: 570px; background-color: #21a1d9;\" width=\"570\" cellspacing=\"9\" cellpadding=\"0\" border=\"0\" bgcolor=\"#21a1d9\">
                <tbody><tr>
                  <td class=\"mobile-row\" style=\"font-size: 0;\" valign=\"top\" align=\"center\">

      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"552\"><tr><![endif]-->
      <!--[if (gte mso 9)|(lte ie 8)]>
      <td align=\"left\" valign=\"top\" width=\"368\">
      <![endif]--><div class=\"mobile-full\" style=\"display: inline-block; max-width: 368px; vertical-align: top; width: 100%;\"> 

                          <table class=\"vb-content\" style=\"border-collapse: separate; width: 100%;\" width=\"368\" cellspacing=\"9\" cellpadding=\"0\" border=\"0\" align=\"left\">
                            <tbody>
                            <tr>
                              <td class=\"long-text links-color\" style=\"text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;\" align=\"left\"><p style=\"Margin: 1em 0px; Margin-top: 0px;\"><span style=\"color: rgb(255, 255, 255);\" data-mce-style=\"color: #ffffff;\"><strong>Paroisse protestante de XXXX</strong></span><br><span style=\"color: rgb(255, 255, 255);\" data-mce-style=\"color: #ffffff;\">Adresse et Ville</span></p><p style=\"Margin: 1em 0px; Margin-bottom: 0px;\"><span style=\"color: rgb(255, 255, 255);\" data-mce-style=\"color: #ffffff;\">+33 3 88 xxxx - www.xxxxx</span></p></td>
                            </tr>
                            
                          </tbody></table>
      </div><!--[if (gte mso 9)|(lte ie 8)]></td>
      <![endif]--><!--[if (gte mso 9)|(lte ie 8)]>
      <td align=\"left\" valign=\"top\" width=\"184\" style=\"; \">
      <![endif]--><div class=\"mobile-full\" style=\"display: inline-block; max-width: 184px; vertical-align: top; width: 100%;\"> 

                          <table class=\"vb-content\" style=\"border-collapse: separate; width: 100%;\" width=\"184\" cellspacing=\"9\" cellpadding=\"0\" border=\"0\" align=\"left\">
                            <tbody><tr>
                              <td class=\"links-color\" width=\"100%\" valign=\"top\" align=\"left\">
                                
                                  <img class=\"mobile-full\" alt=\"\" style=\"border: 0px; display: block; vertical-align: top; width: 100%; height: auto; max-width: 166px;\" src=\"".$urlBase."civicrm/mosaico/img/placeholder?method=placeholder&amp;params=166%2C130\" width=\"166\" vspace=\"0\" hspace=\"0\" border=\"0\">
                                
                              </td>
                            </tr>
                          </tbody></table>

      </div>
      <!--[if (gte mso 9)|(lte ie 8)]></td><![endif]-->

      <!--[if (gte mso 9)|(lte ie 8)]></tr></table><![endif]-->

                  </td>
                </tr>
              </tbody></table>
              </div>
      <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody></table><table style=\"background-color: #ffffff;\" id=\"ko_socialBlock_1\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
          <tbody><tr>
            <td style=\"background-color: #ffffff;\" valign=\"top\" bgcolor=\"#ffffff\" align=\"center\">
      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->
              <div class=\"oldwebkit\" style=\"max-width: 570px;\">
              <table style=\"border-collapse: separate; border-spacing: 9px; width: 100%; max-width: 570px;\" class=\"vb-row fullpad\" width=\"570\" cellspacing=\"9\" cellpadding=\"0\" border=\"0\" align=\"center\">
                <tbody><tr>
                  <td style=\"font-size: 0;\" valign=\"top\" align=\"center\">

      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"552\"><tr><![endif]-->
      <!--[if (gte mso 9)|(lte ie 8)]><td align=\"left\" valign=\"top\" width=\"276\"><![endif]--> 
      <div style=\"display: inline-block; max-width: 276px; vertical-align: top; width: 100%;\" class=\"mobile-full\"> 

                          <table class=\"vb-content\" style=\"border-collapse: separate; width: 100%;\" width=\"276\" cellspacing=\"9\" cellpadding=\"0\" border=\"0\" align=\"left\">
                            <tbody><tr>
                              <td class=\"long-text links-color mobile-textcenter\" style=\"font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #919191; text-align: left;\" valign=\"middle\" align=\"left\"><p style=\"Margin: 1em 0px; Margin-bottom: 0px; Margin-top: 0px;\"><br data-mce-bogus=\"1\"></p></td>
                            </tr>
                          </tbody></table>

      </div><!--[if (gte mso 9)|(lte ie 8)]></td>
      <td align=\"left\" valign=\"top\" width=\"276\">
      <![endif]--><div style=\"display: inline-block; max-width: 276px; vertical-align: top; width: 100%;\" class=\"mobile-full\"> 

                          <table class=\"vb-content\" style=\"border-collapse: separate; width: 100%;\" width=\"276\" cellspacing=\"9\" cellpadding=\"0\" border=\"0\" align=\"right\">
                            <tbody><tr>
                              <td class=\"links-color socialLinks mobile-textcenter\" style=\"font-size: 6px;\" valign=\"middle\" align=\"right\">
                                &nbsp;
                                <a target=\"_new\" href=\"\" style=\"display: inline-block; color: #cccccc; color: #cccccc; text-decoration: underline;\">
                                  <img src=\"".$urlVersafix."img/social_def/facebook_ok.png\" alt=\"Facebook\" class=\"socialIcon\" style=\"border: 0px; display: inline-block; vertical-align: top; padding-bottom: 0px; border-radius: 100%;\" border=\"0\">
                                </a>
                                &nbsp;
                                <a target=\"_new\" href=\"\" style=\"display: inline-block; color: #cccccc; color: #cccccc; text-decoration: underline;\">
                                  <img src=\"".$urlVersafix."img/social_def/twitter_ok.png\" alt=\"Twitter\" class=\"socialIcon\" style=\"border: 0px; display: inline-block; vertical-align: top; padding-bottom: 0px; border-radius: 100%;\" border=\"0\">
                                </a>
                                
                                
                                &nbsp;
                                <a target=\"_new\" href=\"\" style=\"display: inline-block; color: #cccccc; color: #cccccc; text-decoration: underline;\">
                                  <img src=\"".$urlVersafix."img/social_def/web_ok.png\" alt=\"Web\" class=\"socialIcon\" style=\"border: 0px; display: inline-block; vertical-align: top; padding-bottom: 0px; border-radius: 100%;\" border=\"0\">
                                </a>
                                
                                
                                
                                
                                
                                
                                &nbsp;
                                <a target=\"_new\" href=\"\" style=\"display: inline-block; color: #cccccc; color: #cccccc; text-decoration: underline;\">
                                  <img src=\"".$urlVersafix."img/social_def/instagram_ok.png\" alt=\"Instagram\" class=\"socialIcon\" style=\"border: 0px; display: inline-block; vertical-align: top; padding-bottom: 0px; border-radius: 100%;\" border=\"0\">
                                </a>
                                &nbsp;
                                <a target=\"_new\" href=\"\" style=\"display: inline-block; color: #cccccc; color: #cccccc; text-decoration: underline;\">
                                  <img src=\"".$urlVersafix."img/social_def/youtube_ok.png\" alt=\"Youtube\" class=\"socialIcon\" style=\"border: 0px; display: inline-block; vertical-align: top; padding-bottom: 0px; border-radius: 100%;\" border=\"0\">
                                </a>
                              </td>
                              
                            </tr>
                          </tbody></table>

      </div>
      <!--[if (gte mso 9)|(lte ie 8)]></td><![endif]-->
      <!--[if (gte mso 9)|(lte ie 8)]></tr></table><![endif]-->

                  </td>
                </tr>
              </tbody></table>
              </div>
      <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody></table><table class=\"vb-outer\" style=\"background-color: #ffffff;\" id=\"ko_textBlock_2\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
          <tbody><tr>
            <td class=\"vb-outer\" style=\"padding-left: 9px; padding-right: 9px; background-color: #ffffff;\" valign=\"top\" bgcolor=\"#ffffff\" align=\"center\">

      <!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->
              <div class=\"oldwebkit\" style=\"max-width: 570px;\">
              <table class=\"vb-container fullpad\" style=\"border-collapse: separate; border-spacing: 18px; padding-left: 0; padding-right: 0; width: 100%; max-width: 570px; background-color: #ffffff;\" width=\"570\" cellspacing=\"18\" cellpadding=\"0\" border=\"0\" bgcolor=\"#ffffff\">
                <tbody><tr>
                  <td class=\"long-text links-color\" style=\"text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;\" align=\"left\"><p data-mce-style=\"text-align: center;\" style=\"Margin: 1em 0px; Margin-bottom: 0px; Margin-top: 0px;\"><span style=\"color: rgb(51, 102, 255);\" data-mce-style=\"color: #3366ff;\"><span style=\"color: rgb(128, 128, 128);\" data-mce-style=\"color: #808080;\">Si vous ne souhaitez plus recevoir nos courriels, vous pouvez vous désabonner en cliquant sur le lien ci-après : <a href=\"{action.optOutUrl}\" data-mce-style=\"color: #808080;\" style=\"color: #3f3f3f; color: #3f3f3f; text-decoration: underline;\">Se désabonner</a></span><br></span></p></td>
                </tr>
              </tbody></table>
              </div>
      <!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody></table>
        </center>


      </body></html>

    ";

    return $codeHtml;

  }

}
