<script setup>

const year = new Date().getFullYear();

</script>

<template>
  <div>
    <div class="d-flex gap-2">
      <header class="color-b-12 d-flex flex-column justify-content-start pt-4">
        <nav>
          <ul class="px-3 pt-4 d-flex flex-column gap-3">
            <div>
              <li class="color-1 text-center fw-semibold mb-3"><router-link to="/novo" class="color-b-0 btn-default"><img style="width:28px" src="../../../src/assets/images/new.svg" alt="Adicionar Cliente"></router-link><br>Novo</li>
            </div>
            <li><router-link to="/clientes" class="color-b-0 btn-default"><img style="width:28px" src="../../../src/assets/images/account.svg" alt="Clientes"></router-link></li>
            <li><router-link to="/admin" class="color-b-0 btn-default"><img style="width:28px" src="../../../src/assets/images/admin.svg" alt="Administrador"></router-link></li>
            <li><router-link to="/faturas" class="color-b-0 btn-default"><img style="width:28px" src="../../../src/assets/images/faturas.png" alt="Faturas"></router-link></li>
            <li><router-link to="/pesquisa" class="color-b-0 btn-default"><img style="width:28px" src="../../../src/assets/images/search.svg" alt="Pesquisa"></router-link></li>
            <li><router-link to="/extrato" class="color-b-0 btn-default"><img style="width:28px" src="../../../src/assets/images/extrato.svg" alt="Extrato"></router-link></li>
          </ul>
        </nav>
      </header>

      <div id="content" class="w-100">
        <slot />
      </div>
    </div>
    <footer style="color: aliceblue" class="w-100 color-b-14 text-center py-1"> <a class="color-p1" href="https://comprarsite.com" target="_blank"> CS LTDA </a> {{ year }} - Todos os direitos reservados </footer>
  </div>
</template>

<style scoped>
#content {
  height: calc(100vh - 32px);
}
#header {
}
</style>
