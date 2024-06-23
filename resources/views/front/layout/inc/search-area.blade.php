<!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn"><i class="fas fa-window-close"></i></span>
                <div class="search-bar">
                    <div class="search-bar-tablecell">
                        <form action="{{ route('product.search') }}" method="get">

                        <h3>Buscar por: NO</h3>
                        <input type="text" placeholder="palavras chave" name="pesquisinha">
                        <button>Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search area -->
