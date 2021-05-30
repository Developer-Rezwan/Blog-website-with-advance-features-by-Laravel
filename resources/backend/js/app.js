require("./bootstrap");
import jQuery from "jquery";
window.jQuery = window.$ = jQuery;
require("bootstrap");
require("popper.js");
require("@fortawesome/fontawesome-free/js/all.js");
require("./main");

require("startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.js");
require("startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.compatibility");
require("startbootstrap-sb-admin-2/js/sb-admin-2.js");
require("startbootstrap-sb-admin-2/vendor/datatables/jquery.dataTables.min");
require("startbootstrap-sb-admin-2/vendor/datatables/dataTables.bootstrap4.min");
require("startbootstrap-sb-admin-2/js/demo/datatables-demo.js");
//require('startbootstrap-sb-admin-2/js/demo/chart-area-demo.js');
//require('startbootstrap-sb-admin-2/vendor/chart.js/Chart.min.js');
//require('startbootstrap-sb-admin-2/js/demo/chart-pie-demo.js');
require("./adminlte");

let ClassicEditor = require("@ckeditor/ckeditor5-build-classic");
ClassicEditor.create(document.querySelector("#editor")).catch((error) => {});
