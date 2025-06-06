const testimonials = [
    { quote: "I was having trouble with factoring polynomials. MATHMIND provided me with tons of practice problems and explained the concepts in a clear and concise way.", name: "Ng Wei Ming" },
    { quote: "Since using MATHMIND, I've seen a significant improvement in my math grades. I'm more confident in my abilities and I'm actually enjoying math more now!", name: "Harry Yen" },
    { quote: "I particularly appreciate the progress tracking feature, which allows me to monitor my improvement over time and set new goals.", name: "Veronissya Ling" },
    { quote: "I'm a visual learner, and I really appreciate the way MATHMIND uses animations and interactive elements to explain math concepts. It makes learning so much more engaging and easier to grasp.", name: "Cindy Chong" }
];

let index = 0;

document.getElementById("prevBtn").addEventListener("click", () => {
    index = (index - 1 + testimonials.length) % testimonials.length;
    updateTestimonial();
});

document.getElementById("nextBtn").addEventListener("click", () => {
    index = (index + 1) % testimonials.length;
    updateTestimonial();
});

function updateTestimonial() {
    document.getElementById("quote").textContent = `"${testimonials[index].quote}"`;
    document.getElementById("name").textContent = testimonials[index].name;
}
