<template>
  <section class="first-section">
    <div>
      <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#0066CC"
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="lucide lucide-shield w-12 h-12 text-[#0066CC]" aria-hidden="true">
        <path
          d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
        </path>
      </svg>
    </div>
    <span class="title">Sefaz é Massa: transformar imposto em progresso é a nossa arte.</span>
    <span class="body">Os impostos são a base para construir uma sociedade mais justa e desenvolvida. Quando você paga
      seus
      tributos, está investindo em saúde, educação, segurança e infraestrutura para todos os cidadãos de
      Maceió.</span>
    <router-link to="/impostos" custom v-slot="{ navigate }">
      <button @click="navigate">
        Conheça os impostos
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFF"
          stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 w-5 h-5"
          aria-hidden="true">
          <path d="M5 12h14"></path>
          <path d="m12 5 7 7-7 7"></path>
        </svg>
      </button>
    </router-link>
  </section>

  <section class="second-section">
    <span class="title">Por que os Impostos são importantes?</span>
    <ul>
      <li>
        <div class="card card-01">
          <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
              fill="none" stroke="#0066CC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-heart w-8 h-8 text-[#0066CC]" aria-hidden="true">
              <path
                d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5">
              </path>
            </svg></div>
          <span class="card-title">Serviços Essenciais</span>
          <span class="card-body">
            Os impostos financiam hospitais, escolas, postos de saúde e todos os serviços públicos que garantem
            qualidade de vida para a população.
          </span>
        </div>
      </li>
      <li>
        <div class="card card-02">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="#00c951" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-users w-8 h-8 text-green-600" aria-hidden="true">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
              <path d="M16 3.128a4 4 0 0 1 0 7.744"></path>
              <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
              <circle cx="9" cy="7" r="4"></circle>
            </svg>
          </div>
          <span class="card-title">Desenvolvimento Social</span>
          <span class="card-body">Programas sociais, assistência às famílias em situação de vulnerabilidade e projetos
            de inclusão são
            possíveis através da arrecadação tributária.</span>
        </div>
      </li>
      <li>
        <div class="card card-03">
          <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
              fill="none" stroke="#f0b100" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-lightbulb w-8 h-8 text-yellow-600" aria-hidden="true">
              <path
                d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5">
              </path>
              <path d="M9 18h6"></path>
              <path d="M10 22h4"></path>
            </svg></div>
          <span class="card-title">Infraestrutura e Desenvolvimento</span>
          <span class="card-body">Pavimentação de ruas, iluminação pública, coleta de lixo e obras de mobilidade
            urbana dependem dos
            recursos arrecadados.</span>
        </div>
      </li>
    </ul>
  </section>

  <section class="third-section">
    <span class="title">Conhecimento é Cidadania!</span>
    <span class="body"><b>Entender os impostos é um direito e um dever de todo cidadão. </b>Quando você conhece para
      onde vão
      seus tributos e como eles são aplicados, você se torna um agente ativo na fiscalização e na melhoria dos
      serviços públicos.</span>
    <span class="body">A Secretaria Municipal de Fazenda de Maceió acredita na transparência e na educação fiscal como
      pilares
      fundamentais para uma gestão pública eficiente e uma sociedade mais consciente.</span>
    <div>
      <span class="title">💡 Você sabia?</span>
      <span class="body">No Brasil, cerca de 40% do que você paga em produtos e serviços são impostos. Por isso é
        fundamental conhecer cada um deles e entender sua importância para o desenvolvimento do nosso
        município.</span>
    </div>
    <router-link to="/impostos" custom v-slot="{ navigate }">
      <button @click="navigate">Explorar os impostos <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 w-5 h-5" aria-hidden="true">
          <path d="M5 12h14"></path>
          <path d="m12 5 7 7-7 7"></path>
        </svg></button>
    </router-link>
  </section>

  <section class="fourth-section">
    <span class="title">Sua Participação Faz a Diferença</span>
    <span class="body">Ao pagar seus impostos em dia, você contribui para uma Maceió mais justa, desenvolvida e
      preparada para o
      futuro. Seja um cidadão consciente e participativo na construção de uma cidade melhor para todos.</span>
  </section>
</template>

<style scoped>
.first-section {
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 70%;
  margin-top: 70px;
}

.first-section div {
  background-color: #DBEAFE;
  border-radius: 100%;
  width: 90px;
  height: 90px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.first-section .title {
  font-size: 28px;
  font-weight: 600;
  color: #0066CC;
  padding-top: 20px;
  padding-bottom: 20px;

}

.first-section .body {
  text-align: center;
  font-size: 14px;
}

.first-section button {
  margin-top: 30px;
  width: 220px;
  height: 50px;
  border-radius: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  font-size: 14px;
  border: none;
  background-color: #0066CC;
  color: #FFF;
  font-weight: 500;
  cursor: pointer;
  transition: all ease-in-out 0.2s;
}

.first-section button:hover {
  background-color: #025cb5;
  transform: translateY(1px);
}

.second-section {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.second-section .title {
  font-size: 24px;
  margin-bottom: 50px;
  font-weight: 500;
}

.second-section ul {
  display: flex;
  align-items: center;
  flex-direction: row;
  list-style: none;
  gap: 50px;
}

.second-section ul li {
  display: flex;
  justify-content: center;
}

.second-section .card {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 25px;
  background-color: #FFF;
  width: 350px;
  height: 270px;
  border-bottom: 1px solid #a1a1a180;
  border-left: 1px solid #a1a1a180;
  border-right: 1px solid #a1a1a180;
  padding: 30px;
  border-radius: 15px;
  transition: box-shadow 0.5s;

}

.second-section .card:hover {
  box-shadow: 0 10px 15px -3px var(--tw-shadow-color, #0000001a), 0 4px 6px -4px var(--tw-shadow-color, #0000001a);
}

.card-01 {
  border-top: 5px solid #0066CC;
}

.card-01 div {
  width: 70px;
  height: 70px;
  border-radius: 100%;
  background-color: #DBEAFE;
}

.card-01 .card-title {
  font-size: 16px;
  font-weight: 500;
  color: #0066CC;
}

.card-01 .card-body,
.card-02 .card-body,
.card-03 .card-body {
  font-size: 13px;
  text-align: center;
}

.card-02 {
  border-top: 5px solid #00c951;
}

.card-02 div {
  width: 70px;
  height: 70px;
  border-radius: 100%;
  background-color: #DBFCE7;
}

.card-02 .card-title {
  font-size: 16px;
  font-weight: 500;
  color: #00c951;
}

.card-03 {
  border-top: 5px solid #f0b100;
}

.card-03 div {
  width: 70px;
  height: 70px;
  border-radius: 100%;
  background-color: #FEF9C2;
}

.card-03 .card-title {
  font-size: 16px;
  font-weight: 500;
  color: #f0b100;
  text-align: center;
}

.second-section .icon {
  width: 50px;
  height: 50px;
  border-radius: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.third-section {
  width: 70%;
  background-color: #0062C5;
  color: #FFF;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
  padding: 80px 100px 60px 100px;
  border-radius: 15px;
}

.third-section .title {
  font-size: 24px;
  font-weight: 600;
}

.third-section .body {
  font-size: 14px;
}


.third-section div {
  background-color: #1A71C8;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
  padding: 40px;
  border-radius: 15px;
}

.third-section div .title {
  font-size: 20px;
}

.third-section div .body {
  font-size: 14px;
}

.third-section button {
  width: 240px;
  height: 60px;
  border-radius: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  font-size: 14px;
  border: none;
  background-color: #FFF;
  color: #008FE0;
  font-weight: 600;
  cursor: pointer;
  transition: all ease-in-out 0.2s;
}

.third-section button:hover {
  background-color: #d6d6d6;
  transform: translateY(1px);
}

.fourth-section {
  width: 70%;
  background-color: #EFF6FF;
  border-left: 5px solid #0062C5;
  display: flex;
  flex-direction: column;
  gap: 15px;
  padding: 50px;
  margin-bottom: 100px;
}

.fourth-section .title {
  font-size: 16px;
  color: #0062C5;
  font-weight: 500;
}

.fourth-section .body {
  font-size: 14px;
}

@media (max-width: 1024px) {

  .first-section {
    width: 85%;
  }

  .first-section .title {
    font-size: 24px;
  }

  .second-section ul {
    gap: 30px;
  }

  .second-section .card {
    width: 300px;
    height: auto;
  }

  .third-section {
    width: 85%;
    padding: 60px 80px;
  }

  .fourth-section {
    width: 85%;
    padding: 40px;
  }
}

@media (max-width: 768px) {

  .first-section {
    width: 90%;
    margin-top: 60px;
  }

  .first-section .title {
    font-size: 22px;
    text-align: center;
  }

  .first-section .body {
    font-size: 13px;
  }

  .second-section ul {
    flex-direction: column;
    align-items: center;
    gap: 40px;
  }

  .second-section .card {
    width: 80%;
    height: auto;
    padding: 25px;
  }

  .third-section {
    width: 90%;
    padding: 50px;
  }

  .third-section div {
    padding: 25px;
    gap: 20px;
  }

  .third-section button {
    width: 200px;
    height: 50px;
    font-size: 13px;
  }

  .fourth-section {
    width: 90%;
    padding: 35px;
  }
}

@media (max-width: 480px) {

  .first-section {
    width: 85%;
    margin-top: 40px;
  }

  .first-section div {
    width: 70px;
    height: 70px;
  }

  .first-section div svg {
    width: 45px;
    height: 45px;
  }

  .first-section .title {
    font-size: 18px;
  }

  .first-section .body {
    font-size: 12px;
    text-align: justify;
  }

  .first-section button {
    width: 200px;
    height: 45px;
    font-size: 12px;
  }

  .first-section button svg {
    width: 15px;
    height: 15px;
  }

  .second-section .title {
    font-size: 18px;
    text-align: center;
    width: 85%;
  }

  .second-section .card {
    width: 85%;
  }

  .third-section {
    width: 85%;
    padding: 40px 25px;
  }

  .third-section .title {
    font-size: 20px;
    text-align: center;
  }

  .third-section .body {
    font-size: 13px;
    text-align: justify;
  }

  .third-section div {
    padding: 20px;
    gap: 15px;
  }

  .third-section button {
    width: 180px;
    height: 45px;
    font-size: 12px;
  }

  .third-section svg {
    height: 15px;
    width: 15px;
  }

  .fourth-section {
    width: 85%;
    padding: 30px 20px;
  }

  .fourth-section .title {
    font-size: 14px;
  }

  .fourth-section .body {
    font-size: 12px;
  }
}
</style>