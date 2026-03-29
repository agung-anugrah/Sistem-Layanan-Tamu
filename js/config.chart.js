document.addEventListener('DOMContentLoaded', async () => {

    const ctx1 = document.getElementById('myChart1');
    const ctx2 = document.getElementById('myChart2');
    const ctx3 = document.getElementById('myChart3');
    const ctx4 = document.getElementById('myChart4');
    const ctx5 = document.getElementById('myChart5');

    let chart1, chart2, chart3, chart4, chart5;

    async function loadChart(tanggalMulai = "", tanggalAkhir = "") {

        const formData = new FormData();

        if (tanggalMulai && tanggalAkhir) {
            formData.append("simpan", "1");
            formData.append("tanggal_mulai", tanggalMulai);
            formData.append("tanggal_akhir", tanggalAkhir);
        }

        const res = await fetch('../../response/resData.php', {
            method: "POST",
            body: formData
        });

        const data = await res.json();

        
        // Line Chart (jumlah kunjungan perhari)
        if(chart1){
            chart1.data.labels = data.harian.labels;
            chart1.data.datasets[0].data = data.harian.data;
            chart1.update();
        }else{
            chart1 = new Chart(ctx1,{
                type:'line',
                data:{
                    labels:data.harian.labels,
                    datasets:[{
                        label:'Jumlah Kunjungan',
                        data:data.harian.data,
                        borderColor:'#b21f1f',
                        backgroundColor:'rgba(178,31,31,0.2)',
                        tension:0.4,
                        fill:true
                    }]
                },
                options:{
                    plugins:{legend:{display:false}},
                    responsive:true,
                    maintainAspectRatio:false
                }
            });
        }

        
        // dougnut chart (Maksud kunjungan)
        if(chart2){
            chart2.data.labels = data.maksud.labels;
            chart2.data.datasets[0].data = data.maksud.data;
            chart2.update();
        }else{
            chart2 = new Chart(ctx2,{
                type:'doughnut',
                data:{
                    labels:data.maksud.labels,
                    datasets: [{
                    label: 'My First Dataset',
                    data: data.maksud.data,
                    backgroundColor: [
                        '#FF6B6B', // merah coral
                        '#4ECDC4', // turquoise
                        '#45B7D1', // biru muda
                        '#FFA600', // orange
                        '#8E44AD', // ungu
                        '#2ECC71', // hijau
                        '#F39C12', // amber
                        '#3498DB', // biru
                        '#16A085', // green teal
                        '#D35400', // dark orange
                        '#C0392B', // dark red
                        '#7F8C8D'  // abu modern
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                let label = context.label || '';
                                let value = Number(context.raw) || 0;

                                let data = context.chart.data.datasets[0].data.map(Number);
                                let total = data.reduce((a, b) => a + b, 0);

                                let percentage = total ? ((value / total) * 100).toFixed(1) : 0;

                                return `${label}: ${percentage}%`;
                                }
                            }
                        }
                    }
                }
            });
        }

        
        // bar chart (jumllah per tujuan kunjungan)
        if(chart3){
            chart3.data.labels = data.tujuan.labels;
            chart3.data.datasets[0].data = data.tujuan.data;
            chart3.update();
        }else{
            chart3 = new Chart(ctx3,{
                type:'bar',
                data:{
                    labels:data.tujuan.labels,
                    datasets:[{
                        data:data.tujuan.data,
                        backgroundColor:'#2d8bd6',
                        borderRadius: 6,
                        barThickness: 12
                    }]
                },
                options: {
                    indexAxis: 'y', // membuat bar horizontal
                    responsive: true,
                    layout: {},
                    plugins: {
                        legend: {
                            display: false
                        }
                    },scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: '#e5e5e5'
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            ticks:{
                                callback: function(value) {
                                    let label = this.getLabelForValue(value);
                                    let words = label.split(" ");
                                    if (words.length > 3) {
                                        return words.slice(0, 3).join(" ") + "...";
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }


        // bar chart (jumlah kunjungan per jam)
        if(chart4){
            chart4.data.labels = data.jam.labels;
            chart4.data.datasets[0].data = data.jam.data;
            chart4.update();
        }else{
            chart4 = new Chart(ctx4,{
                type:'bar',
                data:{
                    labels:data.jam.labels,
                    datasets:[{
                        data:data.jam.data,
                        backgroundColor:'#2d8bd6',
                        borderRadius: 6,
                        barThickness: 20
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: '#e5e5e5'
                            }
                        },
                        y: {grid: {display: false}}
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        }


        // bar chart (kunjungan per hari kerja)
        if(chart5){
            chart5.data.labels = data.hari.labels;
            chart5.data.datasets[0].data = data.hari.data;
            chart5.update();
        }else{
            chart5 = new Chart(ctx5,{
                type:'bar',
                data:{
                    labels:data.hari.labels,
                    datasets:[{
                        data:data.hari.data,
                        backgroundColor:'#2d8bd6',
                        borderRadius: 5,
                        barThickness: 35
                    }]
                },
                 options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: '#e5e5e5'
                            }
                        },
                        y: {grid: {display: false}}
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

    }

    // load pertama
    loadChart();

    // tombol filter
    document.getElementById("submit").addEventListener("click", () => {

        const tanggalMulai = document.getElementById("tanggal_mulai").value;
        const tanggalAkhir = document.getElementById("tanggal_akhir").value;

        loadChart(tanggalMulai, tanggalAkhir);
    });

});
