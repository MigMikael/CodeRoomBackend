(function() {
  'use strict';

  angular.module('evgenyneu.markdown-preview', [])

  .controller('Ctrl', ['$scope', '$window', '$http', '$sce','$rootScope',
    function($scope, $window, $http, $sce,$rootScope) {
      $scope.md2Html = function() {
        $scope.html = $window.marked($scope.markdown);
        $rootScope.announcement_content = $scope.html;
        console.log($rootScope.announcement_content);

        $scope.htmlSafe = $sce.trustAsHtml($scope.html);
      };

      $scope.initFromUrl = function(url) {
        $http.get(url).success(function(data) {
          $scope.markdown = data;
          return $scope.md2Html();
        });
      };

      $scope.initFromText = function(text) {
        $scope.markdown = text;
        
        $scope.md2Html();
      };
    }
  ])

  .directive('iiMdPreview', function() {
    return {
      template: "<div style='display: block;width: 100%'><textarea class='MdPreview-markdown' style='width: 100%;resize: none;border:1px solid #204056;padding-left: 10px;height: 200px' name='{{textareaName}}' ng-model='markdown' ng-change='md2Html()' placeholder='Content' ></textarea><h4 style='text-align: center'>Show Content</h4><div class='MdPreview-html'  ng-bind-html='htmlSafe' /></div>",
      restrict: 'C',
      replace: true,
      controller: 'Ctrl',
      scope: {},
      link: function(scope, element, attrs) {
        if (attrs.url) {
          scope.initFromUrl(attrs.url);
        }
        if (attrs.text) {
          scope.initFromText(attrs.text);
        }
        scope.textareaName = attrs.textareaName;

      }
    };
  });

}).call(this);
