<script setup>
import { ref, onMounted } from 'vue'
import axiosInstance from "../../services/http.js";

const impostos = ref([])

const loading = ref(true)
const error = ref(null)

const openGlobal = ref(null)

const fetchImpostos = async () => {
    try {
        const response = await axiosInstance.get("impostos", {
            headers: {
                'X-Frontend-Token': 'vue-access-123'
            }
        })

        impostos.value = response.data.map((imposto) => ({
            title: imposto.sigla,
            description: imposto.nome_completo,
            icon: imposto.icone,
            accordion: [
                { summary: 'O que é?', content: imposto.descricao },
                { summary: 'Para que serve?', content: imposto.finalidade },
                {
                    summary: 'Curiosidades',
                    content: (() => {
                        if (!imposto.curiosidades) return []
                        try {
                            const parsed = JSON.parse(imposto.curiosidades)
                            if (Array.isArray(parsed)) return parsed
                            return String(imposto.curiosidades).split('\n').filter(Boolean)
                        } catch {
                            return String(imposto.curiosidades).split('\n').filter(Boolean)
                        }
                    })()
                }
            ],
        }))
    } catch (err) {
        console.error('Erro ao carregar impostos:', err)
        error.value = 'Erro ao carregar os impostos.'
    } finally {
        loading.value = false
    }
}

const getIconSvg = (icon) => {
    const icons = {
        predio: `<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="lucide lucide-building2 w-4 h-4" aria-hidden="true">
      <path d="M10 12h4"></path>
      <path d="M10 8h4"></path>
      <path d="M14 21v-3a2 2 0 0 0-4 0v3"></path>
      <path d="M6 10H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2"></path>
      <path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16"></path>
    </svg>`,
        maleta: `<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="lucide lucide-briefcase w-4 h-4" aria-hidden="true">
      <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
      <rect width="20" height="14" x="2" y="6" rx="2"></rect>
    </svg>`,
        casa: `<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="lucide lucide-house w-4 h-4" aria-hidden="true">
      <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
      <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
    </svg>`,
        carrinho: `<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="lucide lucide-shopping-cart w-4 h-4" aria-hidden="true">
      <circle cx="8" cy="21" r="1"></circle>
      <circle cx="19" cy="21" r="1"></circle>
      <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
    </svg>`,
        dolar: ` <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="lucide lucide-dollar-sign w-4 h-4" aria-hidden="true">
      <line x1="12" x2="12" y1="2" y2="22"></line>
      <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
    </svg>`,
        fabrica: `<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="lucide lucide-factory w-4 h-4" aria-hidden="true">
      <path d="M12 16h.01"></path>
      <path d="M16 16h.01"></path>
      <path d="M3 19a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.5a.5.5 0 0 0-.769-.422l-4.462 2.844A.5.5 0 0 1 15 10.5v-2a.5.5 0 0 0-.769-.422L9.77 10.922A.5.5 0 0 1 9 10.5V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2z"></path>
      <path d="M8 16h.01"></path>
    </svg>`
    }
    return icons[icon] || icons.predio
}

const toggleAccordion = (impostoIndex, itemIndex) => {
    const id = `${impostoIndex}-${itemIndex}`
    openGlobal.value = openGlobal.value === id ? null : id
}

onMounted(fetchImpostos)
</script>

<template>
    <section class="section-impostos">
        <span class="title">Entenda os Impostos</span>
        <span class="body">
            Conheça os principais impostos, suas finalidades e curiosidades. A transparência na arrecadação
            tributária é fundamental para o exercício da cidadania.
        </span>

        <div class="middle-section-impostos">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-info h-4 w-4 text-blue-600" aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 16v-4"></path>
                <path d="M12 8h.01"></path>
            </svg>
            <div>
                <span class="m-title">Educação Fiscal</span>
                <span class="m-body">
                    Os impostos são essenciais para o funcionamento dos serviços públicos. Ao conhecer melhor cada
                    tributo, você se torna um cidadão mais consciente de seus direitos e deveres.
                </span>
            </div>
        </div>

        <div v-if="loading" class="text-loading">
            Carregando impostos...
        </div>

        <div v-else-if="error" class="text-error">
            {{ error }}
        </div>

        <div v-else class="impostos">
            <div v-for="(imposto, i) in impostos" :key="i" class="imposto-card">
                <div class="card-top">
                    <div class="imposto-icon" v-html="getIconSvg(imposto.icon)"></div>

                    <div class="imposto-description">
                        <span class="d-title">{{ imposto.title }}</span>
                        <span class="d-body">{{ imposto.description }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <div v-for="(item, j) in imposto.accordion" :key="j" class="accordion-item">
                        <div class="summary" @click="toggleAccordion(i, j)">
                            {{ item.summary }}
                            <span class="chevron">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-chevron-down text-muted-foreground pointer-events-none size-4 shrink-0 translate-y-0.5 transition-transform duration-200"
                                    :class="{ 'rotate-180': openGlobal === `${i}-${j}` }">
                                    <path d="m6 9 6 6 6-6"></path>
                                </svg>
                            </span>
                        </div>

                        <transition name="accordion">
                            <div v-show="openGlobal === `${i}-${j}`" class="content">
                                <p v-if="typeof item.content === 'string'">{{ item.content }}</p>
                                <ul v-else>
                                    <li v-for="(li, k) in item.content" :key="k">{{ li }}</li>
                                </ul>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>


<style scoped>
.section-impostos {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 30px;
    margin-bottom: 50px;
}

.section-impostos .title {
    color: #0066CC;
    font-size: 28px;
    font-weight: 600;
}

.section-impostos .body {
    font-size: 14px;
    margin-top: 30px;
    margin-bottom: 30px;
    text-align: center;
}

.section-impostos .middle-section-impostos {
    border: 1px solid #bedbff;
    border-radius: 15px;
    background-color: #EFF6FF;
    padding: 10px 20px;
    display: flex;
    gap: 10px;
    align-items: center;
    margin-bottom: 40px;
}

.section-impostos .middle-section-impostos div {
    display: flex;
    flex-direction: column;
}

.section-impostos .middle-section-impostos div .m-title {
    color: #1c398e;
    font-weight: 600;
    font-size: 13px;
}

.section-impostos .middle-section-impostos div .m-body {
    color: #193cb8;
    font-size: 12px;
}

.section-impostos .impostos {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 30px;
}

.section-impostos .impostos .imposto-card {
    background-color: #FFF;
    border: 1px solid #a1a1a180;
    border-radius: 15px;
    padding: 30px;
    width: 400px;
    transition: box-shadow 0.5s;
}

.section-impostos .impostos .imposto-card:hover {
    box-shadow: 0 10px 15px -3px var(--tw-shadow-color, #0000001a), 0 4px 6px -4px var(--tw-shadow-color, #0000001a);
}

.section-impostos .impostos .imposto-card .card-top {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.section-impostos .impostos .imposto-card .imposto-icon {
    background-color: #2b7fff;
    width: 45px;
    height: 45px;
    border-radius: 25%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.section-impostos .impostos .imposto-card .imposto-description {
    display: flex;
    flex-direction: column;
}

.section-impostos .impostos .imposto-card .imposto-description .d-title {
    font-weight: 600;
    font-size: 16px;
}

.section-impostos .impostos .imposto-card .imposto-description .d-body {
    font-size: 13px;
}

.section-impostos .text-loading {
    margin-top: 100px;
    margin-bottom: 150px;
    font-weight: 500;
    border: 1px solid #bedbff;
    border-radius: 15px;
    background-color: #EFF6FF;
    color: #1c398e;
    font-size: 14px;
    padding: 20px;
}

.section-impostos .text-error {
    margin-top: 100px;
    margin-bottom: 150px;
    font-weight: 500;
    border-radius: 15px;
    font-size: 14px;
    padding: 20px;
    background-color: #FEF2F2;
    color: #E7000B;
    border: 1px solid #ffc9c9;
}

.card-body {
    display: flex;
    flex-direction: column;
}

.accordion-item {
    border-bottom: 1px solid #eee;
    font-size: 15px;
}

.accordion-item:last-of-type {
    border-bottom: none;
}

.summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
    font-size: 14px;
    color: #333;
    cursor: pointer;
    padding: 12px 0;
}

.chevron {
    display: inline-block;
    height: 24px;
}

.summary svg {
    transition: transform 0.25s ease;
    transform-origin: center;
}

.rotate-180 {
    transform: rotate(180deg);
}

.accordion-enter-active,
.accordion-leave-active {
    transition: all 0.3s ease;
}

.accordion-enter-from,
.accordion-leave-to {
    max-height: 0;
    opacity: 0;
}

.accordion-enter-to,
.accordion-leave-from {
    max-height: 500px;
    opacity: 1;
}

.content {
    font-size: 12px;
    color: #555;
    line-height: 1.5;
    padding-bottom: 10px;
}

.content ul {
    list-style: disc;
    margin-left: 20px;
}

.content p {
    margin: 0;
}

@media (max-width: 1024px) {
    .section-impostos .impostos {
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .section-impostos .impostos .imposto-card {
        width: 100%;
        padding: 25px;
    }

    .section-impostos .title {
        font-size: 26px;
    }

    .section-impostos .body {
        font-size: 13px;
        width: 80%;
    }

    .section-impostos .middle-section-impostos {
        width: 80%;
        padding: 15px 25px;
    }
}

@media (max-width: 768px) {
    .section-impostos {
        margin-top: 20px;
        margin-bottom: 40px;
    }

    .section-impostos .title {
        font-size: 22px;
        text-align: center;
    }

    .section-impostos .body {
        font-size: 13px;
        width: 85%;
    }

    .section-impostos .middle-section-impostos {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        width: 90%;
    }

    .section-impostos .middle-section-impostos .m-title {
        font-size: 13px;
    }

    .section-impostos .middle-section-impostos .m-body {
        font-size: 12px;
    }

    .section-impostos .impostos {
        grid-template-columns: 1fr;
        width: 90%;
    }

    .section-impostos .impostos .imposto-card {
        width: 100%;
        padding: 25px;
    }

    .summary {
        font-size: 13px;
    }

    .content {
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .section-impostos {
        width: 90%;
    }
    .section-impostos .title {
        font-size: 18px;
    }

    .section-impostos .body {
        font-size: 12px;
        margin: 20px 0;
        text-align: justify;
    }

    .section-impostos .middle-section-impostos {
        width: 95%;
        padding: 12px 18px;
        flex-direction: row;
        align-items: center;
        gap: 18px;
    }

    .section-impostos .middle-section-impostos svg {
        height: 50px;
        width: 50px;
    }

    .section-impostos .middle-section-impostos div .m-title {
        font-size: 12px;
        padding-bottom: 5px;
    }

    .section-impostos .middle-section-impostos div .m-body {
        font-size: 11px;
        text-align: justify;
    }

    .section-impostos .impostos {
        grid-template-columns: 1fr;
        gap: 20px;
        width: 95%;
    }

    .section-impostos .impostos .imposto-card {
        width: 100%;
        padding: 20px;
    }

    .section-impostos .impostos .imposto-card .imposto-icon {
        width: 40px;
        height: 40px;
    }

    .section-impostos .impostos .imposto-card .imposto-description .d-title {
        font-size: 14px;
    }

    .section-impostos .impostos .imposto-card .imposto-description .d-body {
        font-size: 12px;
    }

    .summary {
        font-size: 12px;
    }

    .content {
        font-size: 11px;
    }
}
</style>