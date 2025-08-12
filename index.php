<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tech News</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#2E61F9',
                        'secondary': '#F5F5F5',
                        'accent': '#333333',
                        'gray': '#8E8E8E',
                    },
                    screens: {
                        'phone': '460px',
                        'tablet': '640px',
                        'laptop': '1024px',
                        'desktop': '1280px',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    },
                    fontSize: {
                        '10': ['10px', {
                            lineHeight: '12px',
                        }],
                        '12': ['12px', {
                            lineHeight: '14.4px',
                        }],
                        '14': ['14px', {
                            lineHeight: '19.1px',
                        }],
                        '16': ['16px', {
                            lineHeight: '19.2px',
                        }],
                        '18': ['18px', {
                            lineHeight: '24.55px',
                        }],
                        '20': ['20px', {
                            lineHeight: '24.55px',
                        }],
                        '24': ['24px', {
                            lineHeight: '39.5px',
                        }],
                        '32': ['32px', {
                            lineHeight: '38.4px',
                        }],
                        '36': ['36px', {
                            lineHeight: '49.1px',
                        }],
                        '40': ['40px', {
                            lineHeight: '48.76px',
                        }],
                        '48': ['48px', {
                            lineHeight: '65px',
                        }],
                        '51': ['51px', {
                            lineHeight: '45.74px',
                        }],
                        '63': ['63px', {
                            lineHeight: '56px',
                        }],
                    },
                    
                },
            },
        }
    </script>

</head>
<body class="relative bg-white min-h-screen overflow-hidden px-20">
    <div class="absolute -right-20 -top-20 laptop:-right-28 laptop:-top-28 w-2/3 laptop:w-1/3 aspect-square rounded-full bg-gradient-to-bl from-primary opacity-50 blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 laptop:-left-28 laptop:-bottom-28 w-2/3 laptop:w-1/3 first-line:w-1/3 aspect-square rounded-full bg-gradient-to-bl from-primary opacity-50 blur-3xl"></div>

    <div class="max-w-6xl mx-auto py-24 laptop:py-32">
        <div class="bg-secondary px-3 py-2 w-fit rounded-full mb-4 mx-auto text-gray text-sm">
            Latest Articles
        </div>
        <h1 class="text-40 laptop:text-32 font-bold text-center mb-4">Discover Our Latest News</h1>
        <h5 class="text-sm laptop:text-base text-center text-gray mb-10">Discover the achievements that set us apart, From groundbreaking projects to industry accolades, we take pride in our accomplishments.</h5>

        <div id="news-container" class="grid grid-cols-1 laptop:grid-cols-3 gap-6 desktop:gap-10">
        </div>
    </div>

    <script>
        const fetchNews = async () => {
            try {
                const res = await fetch('fetch_news.php');
                const json = await res.json();

                if (!json.status) {
                    document.getElementById('news-container').innerHTML = `<p class="col-span-3 text-center text-red-500">${json.message}</p>`;
                    return;
                }

                if (json.data.length === 0) {
                    container.innerHTML = `<p class="col-span-3 text-center text-gray-500">No news found</p>`;
                    return;
                }

                const container = document.getElementById('news-container');
                container.innerHTML = '';


                json.data.forEach(news => {
                    const card = document.createElement('a');
                    card.className = "relative flex flex-col justify-end items-center bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 w-full h-96 hover:scale-105 cursor-pointer";
                    card.setAttribute('target', '_blank');
                    card.setAttribute('href', news.url);

                    card.innerHTML = `
                        <img src="${news.image || 'https://placehold.co/200x400'}" alt="${news.title}" class="absolute top-0 left-0 rounded-lg h-full w-full object-cover z-10">
                        <div class="flex flex-col justify-center items-start z-20 p-4"> 
                            <div class="bg-white px-4 pt-1 rounded-b-none rounded-lg">
                                <p class="text-pink-700">${news.source}</p>
                            </div>
                            
                            <div class="bg-white p-4 rounded-r-lg">
                                <p class="text-xl font-bold line-clamp-2">${news.title}</p>
                                <p class="text-base mt-2 line-clamp-2">${news.description || ''}</p>
                            </div>

                            <div class="text-sm flex justify-start items-center bg-white p-1 rounded-t-none rounded-lg text-nowrap truncate px-4 pt-1">
                                <p class="text-sm font-light">${new Date(news.publishedAt).toLocaleString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                            </div>
                            
                        </div>
                    `;

                    container.appendChild(card);
                });
            } catch (error) {
                console.error(error);
                document.getElementById('news-container').innerHTML = `<p class="col-span-3 text-center text-red-500">Error loading news</p>`;
                // document.getElementById('news-container').innerHTML = `<p class="text-center text-red-500">${error}</p>`;
            }
        }

        fetchNews();
    </script>
</body>
</html>
