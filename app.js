angular.module('leaveApp', [])
    .controller('leaveController', function() {
        var vm = this;
        vm.formData = {};

        vm.submitForm = function() {
            // Perform form submission logic here (e.g., sending data to a server).
            console.log(vm.formData);
        };
    });
