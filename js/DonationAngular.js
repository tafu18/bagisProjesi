var app = angular.module("donationApp", []);
app.controller("donationCtrl", function($scope, $http, $timeout){
/*   $scope.donation_types = ['Yemek Kartı Yardımı (Üniversite için)', 'Elbise Yardımı', 'Ayakkabı Yardımı', 'Mont Yardımı', 'Soba Yakıtı Yardımı',
   'Eğitim Masrafı Yardımı', 'Kitap Yardımı', 'Fatura Yardımı', 'Yemek Yardımı', 'Diğer Yardımlar']; */
   $scope.deneme = "Denemedir. ";

   $scope.donation_types = [ 
        {donation_code: "1",    donation_name: "Yemek Kartı Yardımı (Üniversite için)",  donation_img: "images/neu-footer-logo.png", donation_color: "#253949"},
        {donation_code: "2",    donation_name: "Elbise Yardımı",                         donation_img: "images/kiyafet.png" , donation_color: "#45A074"},
        {donation_code: "3",    donation_name: "Ayakkabı Yardımı",                       donation_img: "images/ayakkabi.png" , donation_color: "#287AB8"},
        {donation_code: "5",    donation_name: "Yakacak Yardımı",                        donation_img: "images/komur.png" , donation_color: "#3C3F46"},
        {donation_code: "6",    donation_name: "Eğitim Masrafı Yardımı",                 donation_img: "images/egitim.png" , donation_color: "#FFCC00"},
        {donation_code: "7",    donation_name: "Kitap Yardımı",                          donation_img: "images/kitap.png" , donation_color: "#6CEEEC"},
        {donation_code: "8",    donation_name: "Fatura Yardımı",                         donation_img: "images/fatura.png" , donation_color: "#8B0000"},
        {donation_code: "9",    donation_name: "İaşe Yardımı",                           donation_img: "images/yemek.png" , donation_color: "#FFAF3D"},
        {donation_code: "10",   donation_name: "Diğer Yardımlar",                        donation_img: "images/diger.png" , donation_color: "#BB78BC"},
    ];

    $scope.isSelect = false;
    $scope.isSelectDonation = false;

    $scope.toggleDonation = function(){
        $scope.isSelectDonation = $scope.isSelectDonation ? false : true;
        if($scope.isSelectDonation == true) $scope.isSelect = false;
    },

    $scope.toggle = function(){
        $scope.isSelect = $scope.isSelect ? false : true;
        if($scope.isSelect == true) $scope.isSelectDonation = false;
    },

    $scope.getClass = function() {
        if($scope.isSelect) {
            return 'selected';
        }
        else {
            return 'unSelected';
        }
    },

    $scope.getClass2 = function(){
        if($scope.isSelectDonation)
            return 'selected'
        else {
            return 'unSelected';
        }
    }

    $scope.type = 99;
});

app.controller("demandsCtrl", function($scope, $http, $timeout){
    $scope.sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

    $scope.shoes_sizes = [];
    for (let i = 25;  i<= 47; i++) {
        $scope.shoes_sizes.push(i);
    }
});

app.controller("deneme", function($scope, $http, $timeout){
        $http.get("deneme.php").then(function (response) {
            $scope.controls = response.data;
            console.log($scope.controls);
        });

    $scope.pass_the_control = function(){
/*         $http.post("control_pass.php", {
            'donation_id': $scope.donation_id, 
            'demand_id': $scope.demand_id,
        }).then(function(data){ */
            console.log("pass the control");
/*             $scope.control.donation_id = null, 
            $scope.control.demand_id = null
        }) */
    }
});

