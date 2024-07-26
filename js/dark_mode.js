var darkMode;
    if (localStorage.getItem('dark-mode')) {
      darkMode = localStorage.getItem('dark-mode');
    } else {
      darkMode = 'light';
    }
    localStorage.setItem('dark-mode', darkMode);
    if (localStorage.getItem('dark-mode') == 'dark') {
      $('h4, button').not('.check').not('.btn-add, #calendar').addClass('dark-grey-text text-white');
      $('.list-panel a').addClass('dark-grey-text');
      $('footer, .card').addClass('dark-card-admin');
      $('body, .navbar').addClass('white-skin navy-blue-skin');
      $(this).addClass('white text-dark btn-outline-black');
      $('body').addClass('dark-bg-admin');
      $('h6, .card, p, td, th, i, li a, h4, input, label').not(
        '#slide-out i, #slide-out a, .dropdown-item i, .dropdown-item, #calendar').addClass('text-white');
      $('.btn-dash').addClass('grey blue').addClass('lighten-3 darken-3');;
      $('.list-panel a').addClass('navy-blue-bg-a text-white').addClass('list-group-border');
      $('#dark-button').attr('hidden', true);
      $('#light-button').removeAttr('hidden');
    }
    $('#dark-button').on('click', function() {
      $('#dark-button').attr('hidden', true);
      $('#light-button').removeAttr('hidden');
      $('h4, button').not('.check').not('.btn-add, #calendar').addClass('dark-grey-text text-white');
      $('.list-panel a').addClass('dark-grey-text');
      $('footer, .card').addClass('dark-card-admin');
      $('body, .navbar').addClass('white-skin navy-blue-skin');
      $('body').addClass('dark-bg-admin');
      $('h6, .card, p, td, th, i, li a, h4, input, label').not(
        '#slide-out i, #slide-out a, .dropdown-item i, .dropdown-item, #calendar').addClass('text-white');
      $('.btn-dash').addClass('grey blue').addClass('lighten-3 darken-3');
      $('.list-panel a').addClass('navy-blue-bg-a text-white').addClass('list-group-border');
      localStorage.setItem('dark-mode', 'dark');
    });
    $('#light-button').on('click', function() {
      $('#light-button').attr('hidden', true);
      $('#dark-button').removeAttr('hidden');
      $('h4, button').not('.check, #calendar').removeClass('dark-grey-text text-white');
      $('.list-panel a').removeClass('dark-grey-text');
      $('footer, .card').removeClass('dark-card-admin');
      $('body, .navbar').removeClass('white-skin navy-blue-skin');
      $('body').removeClass('dark-bg-admin');
      $('h6, .card, p, td, th, i, li a, h4, input, label').not(
        '#slide-out i, #slide-out a, .dropdown-item i, .dropdown-item, #calendar').removeClass('text-white');
      $('.btn-dash').removeClass('grey blue').removeClass('lighten-3 darken-3');
      $('.gradient-card-header').removeClass('white black lighten-4');
      $('.list-panel a').removeClass('navy-blue-bg-a text-white').removeClass('list-group-border');
      localStorage.setItem('dark-mode', 'light');
    });
