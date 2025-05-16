(function (angular, $, _) {
  "use strict";

  angular.module('crmSearchDisplayPaged').component('crmSearchDisplayPaged', {
    bindings: {
      apiEntity: '@',
      search: '<',
      display: '<',
      settings: '<',
      filters: '<',
      totalCount: '<'
    },
    require: {
      afFieldset: '?^^afFieldset'
    },
    templateUrl: '~/crmSearchDisplayPaged/searchDisplayPaged.html',
    controller: function ($scope, $element, searchDisplayBaseTrait, searchDisplaySortableTrait) {
      var ts = $scope.ts = CRM.ts('fr.uepalparoisse.civiparoisse'),

        // Mix in copies of traits to this controller
        ctrl = angular.extend(this, _.cloneDeep(searchDisplayBaseTrait), _.cloneDeep(searchDisplaySortableTrait));
      $scope.$watch("$ctrl.settings.maxsortgroup", function () {
        ctrl.getResultsSoon();
      });
      this.$onInit = function () {
        this.initializeDisplay($scope, $element);
        ctrl.breaks = [];
        ctrl.onPostRun = ctrl.onPostRun || [];
        ctrl.shouldBreak = function (rowPointer) {
          var res = false;
          if (rowPointer == 0) {
            res = true;
          } else {
            var sort = this.sort || [];
            for (var i = 0; res == false && i < this.sort.length && i < this.settings.maxsortgroup; i++) {
              var colkey = this.sort[i][0];
              if (this.results[rowPointer]['data'][colkey] != this.results[rowPointer - 1]['data'][colkey]) {
                res = true;
              }
            }
          }
          return res;
        };
        ctrl.getColByKey=function (key){
          var res= null;
          for(var i=0;i<ctrl.settings.columns.length && res==null ;i++){
            if(ctrl.settings.columns[i].key==key)
            {
              res=ctrl.settings.columns[i];
            }
          }
          return res;
        }
        ctrl.isBreakable = function () {
          var res = true;
          for (var i = 0; i < this.sort.length && res && i < this.settings.maxsortgroup; i++) {
            var found = false;
            var currentKey = this.sort[i][0];
            for (var j = 0; j < this.settings.columns.length && found == false; j++) {
              if (currentKey == this.settings.columns[j].key) {
                found = true;
              }
            }
            if (!found) {
              res = false;
            }
          }
          return res;
        };
        ctrl.computeBreaks = function () {
          this.breaks = [];

          if (this.results.length > 0) {
            if (this.isBreakable()) {
              var breakpoints = [];
              for (var i = 0; i < this.results.length; i++) {
                if (this.shouldBreak(i)) {
                  breakpoints.push(i);
                }
              }
              breakpoints.push(this.results.length);
              for (var i = 0; i < breakpoints.length - 1; i++) {
                var currentRange = [];
                for (var j = breakpoints[i]; j < breakpoints[i + 1]; j++) {
                  currentRange.push(j);
                }
                this.breaks.push(currentRange);
              }
            } else {
              var defaultBreak = [];
              for (var i = 0; i < this.results.length; i++) {
                defaultBreak.push(i);
              }

              this.breaks.push(defaultBreak);
            }
          }

          return this.breaks;
        };
        ctrl.onPostRun.push(ctrl.computeBreaks);
      };

    }
  });

})(angular, CRM.$, CRM._);
