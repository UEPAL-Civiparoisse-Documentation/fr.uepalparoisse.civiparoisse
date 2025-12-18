(function(angular, $, _) {
  "use strict";

  angular.module('civiparoisseSearchTasks').controller('civiparoisseSearchTaskParentMailing', function($scope, crmApi4, searchTaskBaseTrait, formatForSelect2) {
    var ts = $scope.ts = CRM.ts('fr.uepalparoisse.civiparoisse'),
      // Combine this controller with model properties (ids, entity, entityInfo) and searchTaskBaseTrait
      ctrl = angular.extend(this, $scope.model, searchTaskBaseTrait),
      mailingId;

    this.mailing = {
      name: '',
      template_type: null,
    };
    this.entityTitle = this.getEntityTitle();

    // This option is needed to determine whether the mailing will be handled by CiviMail or Mosaico
    crmApi4({
      templateTypes: ['Mailing', 'getFields', {
        loadOptions: ['id', 'label', 'description'],
        where: [['name', '=', 'template_type']]
      }, ['options']]
    }).then(function(results) {
      ctrl.templateTypes = formatForSelect2(results.templateTypes[0], 'id', 'label', ['description']);
      ctrl.mailing.template_type = ctrl.templateTypes[0].id;

    });

    this.submit = function() {
      ctrl.start({
        values: {
          title: 'Hidden Group ' + Date.now(),
          is_hidden: true,
          'group_type:name': ['Mailing List'],
        },
        chain: {
          mailing: ['Mailing', 'create', {
            values: ctrl.mailing,
          }, 0],
          mailingGroup: ['MailingGroup', 'create', {
            values: {
              group_type: 'Include',
              'entity_table:name': 'Group',
              entity_id: '$id',
              mailing_id: '$mailing.id'
            },
          }, 0],
          recipients:['Contact','get',{
            select: ['r.contact_id_b'],
            join: [['Relationship AS r', 'INNER', ['id', '=', 'r.contact_id_a'],['r.relationship_type_id:name', '=', '"Child of"']]],
            where: [['id', 'IN', ctrl.ids]],
            groupBy: ['r.contact_id_b']

          },['r.contact_id_b']]
        }
      });
    };

    // After running first api call to create group & mailing,
    // This runs a batch of api calls to add contacts to the mailing group
    this.afterGroupCreate = function(result) {
      mailingId = result[0].mailing.id;
      ctrl.parentids=result[0].recipients;
      ctrl.addContacts = {
        defaults: {group_id: result[0].id}
      };
    };

    this.onSuccess = function(result) {
      window.location = CRM.url('civicrm/a#/mailing/' + mailingId);
    };

    this.onError = function() {
      CRM.alert(ts('An error occurred while attempting to create mailing.'), ts('Error'), 'error');
      this.cancel();
    };

  });
})(angular, CRM.$, CRM._);
