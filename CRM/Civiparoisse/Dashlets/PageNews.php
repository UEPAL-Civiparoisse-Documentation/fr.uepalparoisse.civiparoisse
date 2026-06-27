<?php

class CRM_Civiparoisse_Dashlets_PageNews extends CRM_Dashlet_Page_Blog
{
  use CRM_Civiparoisse_Dashlets_ConfigTrait;

  const DASHBOARD_SOMMAIRE = 'civiparoisse-news';
  const DASHBOARD_URL = 'civicrm/civiparoisse-news';
  const DASHBOARD_LABEL = 'Nouvelles de CiviParoisse';
  const DASHBOARD_FULLURL = 'civicrm/civiparoisse-news?reset=1&context=dashletFullscreen';
  const DASHBOARD_PERMISSION = 'access CiviCRM';
  const DASHBOARD_COLUMN = 1;
  const DASHBOARD_WEIGHT = 0;

  const CACHE_NAME='default';

  const CACHE_KEY='civiparoisse_newsfeed';

  const CIVIPAROISSE_NEWS_DEFAULT_URL = "https://uepal-civiparoisse-documentation.github.io/NewsDashlet/rss.xml";
  const CIVIPAROISSE_NEWS_SETTING = "civiparoisse_news_url";

  /**
   * @inheritDoc
   * @return array|mixed
   */
  protected function getData() {
    $value = Civi::cache(self::CACHE_NAME)->get(self::CACHE_KEY);

    if (!$value) {
      $value = $this->getFeeds();

      if ($value) {
        Civi::cache(self::CACHE_NAME)->set(self::CACHE_KEY, $value, (60 * 60 * 24 * self::CACHE_DAYS));
      }
    }

    return $value;
  }
  /**
   * @inheritDoc
   * @return string
   */
  public function getNewsUrl(): string
  {
    $url = Civi::settings()->get(self::CIVIPAROISSE_NEWS_SETTING);
    if ($url === '*default*') {
      $url = self::CIVIPAROISSE_NEWS_DEFAULT_URL;
    }
    return CRM_Utils_System::evalUrl($url);
  }

  /**
   * @inheritDoc
   */
  protected function retrieveDashletColumn(): int
  {
    return self::DASHBOARD_COLUMN;
  }

  /**
   * @inheritDoc
   */
  protected function retrieveDashletWeight(): int
  {
    return self::DASHBOARD_WEIGHT;
  }


  /**
   * @inheritDoc
   */
  public function retrieveDashletName(): string
  {
    return self::DASHBOARD_SOMMAIRE;
  }

  /**
   * @inheritDoc
   */
  protected function retrieveDashboardPermission(): string
  {
    return self::DASHBOARD_PERMISSION;
  }

  /**
   * @inheritDoc
   */
  protected function retrieveDashboardLabel(): string
  {
    return self::DASHBOARD_LABEL;
  }

  /**
   * @inheritDoc
   */
  protected function retrieveDashboardURL(): string
  {
    return self::DASHBOARD_URL;
  }

  /**
   * @inheritDoc
   */
  protected function retrieveDashboardFullURL(): string
  {
    return self::DASHBOARD_FULLURL;
  }


}
