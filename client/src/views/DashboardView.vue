<script>
export default {
  name: 'DashboardChart',
  mounted() {
    const ctx = document.getElementById('entries').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Último mês', 'Atual', 'Média(3)'],
        datasets: [{
          label: 'Valor em R$',
          data: [3000, 2300, 2400],
          backgroundColor: [
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 206, 86, 0.2)',
   
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(255, 206, 86, 1)',
          ],
          borderWidth: 1
        }]
      },
    });
  }
};

</script>

<template>
  
  <div class="px-4 gap-3 d-grid mt-4">
    <!-- Fisrt data -->
    <div class="row gap-3">
      <div class="item-dash col">
        <p class="fw-bold color-9">Lucro Liquido</p>

        <div>
          <canvas id="entries"></canvas>
        </div>

      </div>
      <div class="item-dash col">
          <p class="fw-bold color-9">Extrato Entradas</p>
      </div>
      <div class="item-dash col">
        <p class="fw-bold color-9">Extrato Entradas</p>
      </div>
      <div class="item-dash col">
        <p class="fw-bold color-9">Extrato Entradas</p>
      </div>
    </div>

    <!-- Secund data -->
    <div class="row gap-3">
      <div class="item-dash col">
        <p class="fw-bold color-9">Lucro Liquido</p>

        <ul>
          <li>Último mês:</li>
        </ul>
      </div>
      <div class="item-dash col">
          <p class="fw-bold color-9">Extrato Entradas</p>
      </div>
      <div class="item-dash col">
        <p>Em aberto</p>
      </div>
      <div class="item-dash col">
        <p>Entrada</p>
      </div>
    </div>

    <!-- Secund data -->
    <div class="row gap-3">
      <div class="item-dash col">
        <p class="fw-bold color-9">Lucro Liquido</p>

        <ul>
          <li>Último mês:</li>
        </ul>
      </div>
      <div class="item-dash col">
        <p>Faturas</p>
      </div>
      <div class="item-dash col">
        <p>Em aberto</p>
      </div>
      <div class="item-dash col">
        <p>Entrada</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.item-dash {
  border: 1px solid var(--color-6);
  border-radius: 4px;
  padding: 10px;
  min-height: 200px;
}
</style>
