// $(document).ready(function () {
//   $(".menu-user > ul > li").click(function (e) {
//       e.preventDefault(); // Prevenir comportamento padrão do link

//       // Remover a classe active dos irmãos e adicionar ao elemento clicado
//       $(this).toggleClass("active").siblings().removeClass("active");

//       // Toggle para abrir ou fechar o submenu do item clicado
//       $(this).find(".sub-menu-user").slideToggle();

//       // Fechar os submenus dos outros itens se estiverem abertos
//       $(this).siblings().find(".sub-menu-user").slideUp();

//       // Remover a classe active dos itens do submenu dos irmãos
//       $(this).siblings().find("li").removeClass("active");
//   });

//   $(".menu-btn-user").click(function (e) {
//       e.preventDefault(); // Prevenir comportamento padrão do botão

//       // Adicionar ou remover a classe active da barra lateral
//       $(".sidebar-user").toggleClass("active-user");
//   });
// });

$(document).ready(function () {
  $(".menu-user > ul > li > a").click(function (e) {
      // Verificar se o elemento clicado tem um submenu
      if ($(this).siblings(".sub-menu-user").length > 0) {
          e.preventDefault(); // Prevenir comportamento padrão apenas para itens com submenu
          $(this).parent().toggleClass("active").siblings().removeClass("active");
          $(this).siblings(".sub-menu-user").slideToggle();
          $(this).parent().siblings().find(".sub-menu-user").slideUp();
          $(this).parent().siblings().find("li").removeClass("active");
      }
  });

  $(".menu-btn-user").click(function (e) {
      e.preventDefault(); // Prevenir comportamento padrão do botão
      $(".sidebar-user").toggleClass("active-user");
  });
});
