/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

function ChangeTab1(){
    var triggerEl = document.querySelector('#myTab a[href="#data-ex-tab2"]');
    alert(triggerEl);
    bootstrap.Tab.getInstance(triggerEl).show();
}

