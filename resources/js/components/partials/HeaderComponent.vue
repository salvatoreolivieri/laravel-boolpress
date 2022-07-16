<template>
  <header>
    <nav>
        <ul>
            <ul>
                <li><a class="active" href="">Home</a></li>
                <li><a href="">Blog</a></li>
                <li><a href="">Chi siamo</a></li>
                <li><a href="">Contatti</a></li>
            </ul>
        </ul>
    </nav>
  </header>
</template>

<script>
export default {
    name:'HeaderComponent'
}
</script>

<style lang="scss" scoped>

header{

    background: #F8F9FA;
    height: 80px;

    margin-bottom: 50px;
    border-bottom: 1px solid #dee2e6 ;

    nav{

        ul{
            list-style: none;
            text-align: center;

            li{
                display: inline-block;
                line-height: 80px;
                margin-right: 20px;

                a{
                    text-decoration: none;
                    color: black;
                    cursor: pointer;

                    &:hover{
                        text-decoration: underline;
                    }

                    &.active{
                        color: #0D6EFD;
                        text-decoration: underline;

                    }
                }
            }
        }
    }

}

</style>
