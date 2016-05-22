var controllerPublic = function () {
    this.test = "Test of JS Controller"
};

controllerPublic.prototype.testJS = function () {
   console.log(this.test);
};

controllerPublic.prototype.init = function () {
    this.testJS();
};

$(function () {
    var controller = new controllerPublic();
    controller.init();
});