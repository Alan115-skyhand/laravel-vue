<!DOCTYPE html>
<html>
@include("../components/head")
<body>
    <div id="app" class="l-tracking">
        @include("../components/header-user")
        <main>
            <div class="l-wrap l-wrap--table">
                <user-invoice-store-component id={{$id}}></user-invoice-store-component>
            </div>
        </main>
    </div>
    @include("../components/footer")
</body>
</html>