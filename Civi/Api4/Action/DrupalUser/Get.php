<?php

/** TODO
 * Afficher l'heure correcte (UTC +1, +2 en été) sur la ligne 'access'
 * Remplacer le EntityQuery par le UserListBuilder
 * Pour les dates (access et created), travailler avec des timestamps et non des dates formatées, pour faciliter la comparaison dans les Saved Searches (Smarty).
 */

namespace Civi\Api4\Action\DrupalUser;

use Civi\Api4\Generic\BasicGetAction;
use Civi\Api4\Generic\Result;
use Drupal\user\Entity\User;
use Drupal\user\Entity\Role;
use Drupal\user\UserListBuilder;

class Get extends BasicGetAction {

  protected function getRecord($item = NULL) {
    $results = [];

    // Utilisation de EntityQuery avec accessCheck(FALSE) (obligatoire depuis Drupal 10.1).
    $uids = \Drupal::entityQuery('user')
      ->accessCheck(TRUE)
      ->condition('uid', 0, '>')
      ->execute();

    if (empty($uids)) {
      return [];
    }

    // Chargement des entités utilisateur.
    $users = User::loadMultiple($uids);

    foreach ($users as $user) {
      /** @var \Drupal\user\Entity\User $user */
      
      $role_ids = $user->getRoles();
      $roles = Role::loadMultiple($role_ids);

      $role_labels = [];
      foreach ($roles as $role) {
        /** @var \Drupal\user\Entity\Role $role */
        $role_labels[] = $role->label();
      }

      $results[] = [
        'uid' => $user->id(),
        'user_name' => $user->getAccountName(),
        'created' => $user->getCreatedTime() ? \Drupal::service('date.formatter')->format($user->getCreatedTime(), 'custom', 'Y-m-d') : null,
        'access' => $user->getLastAccessedTime() ? \Drupal::service('date.formatter')->format($user->getLastAccessedTime(), 'custom', 'Y-m-d') : null,
        'roles' => $role_labels,
        'status' => $user->isActive() ? 'Actif' : 'Bloqué',
        'mail' => $user->getEmail(),
      ];
    }

    return $results;
  }

  public function _run(Result $result) {
    $result->exchangeArray($this->getRecord());
  }
}
