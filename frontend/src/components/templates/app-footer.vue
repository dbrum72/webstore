<template>
  <div class="footer">
    <span class="copyright">Rodapé</span>
  </div>
</template>
    
<script>
export default {
  name: "AppFooter",
};
</script>

<style>
.footer {
  grid-area: appFooter;
    display: flex;
    flex-flow: row wrap;
    justify-content: center;
    align-items: start;
    padding: 15px;
    border-top: solid 2px rgba(255, 255, 255, 0.1);
    background-color:#f0eeee
}

.copyright {
  width: 100%;
}

</style>