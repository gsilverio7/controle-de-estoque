let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/assets/sass/custom.scss', 'public/css/custom.css')
   .minify('resources/assets/js/custom.js', 'public/js/custom.js')   
   .minify('resources/assets/js/clientes-form.js', 'public/js/clientes-form.js')
   .minify('resources/assets/js/clientes-tabela.js', 'public/js/clientes-tabela.js')
   .minify('resources/assets/js/estoque-tabela.js', 'public/js/estoque-tabela.js')
   .minify('resources/assets/js/home.js', 'public/js/home.js')
   .minify('resources/assets/js/movimentacoes-tabela.js', 'public/js/movimentacoes-tabela.js')
   .minify('resources/assets/js/produtos-compostos-form.js', 'public/js/produtos-compostos-form.js')
   .minify('resources/assets/js/produtos-compostos-tabela.js', 'public/js/produtos-compostos-tabela.js')
   .minify('resources/assets/js/produtos-simples-tabela.js', 'public/js/produtos-simples-tabela.js')
   .minify('resources/assets/js/requisicoes-form.js', 'public/js/requisicoes-form.js')
   .minify('resources/assets/js/requisicoes-tabela.js', 'public/js/requisicoes-tabela.js')
   .minify('resources/assets/js/usuarios-tabela.js', 'public/js/usuarios-tabela.js');