//Menu Burger
function toggleMenu(){
    const navbar = document.querySelector('.navbar') ; 
    const burger = document.querySelector('.burger');
    burger.addEventListener('click', () => {
        navbar.classList.toggle('show-nav');
    })
}
toggleMenu();

//Modal
const modalContainer = document.querySelector(".modal-container");
const modalTriggers = document.querySelectorAll(".modal-trigger");

modalTriggers.forEach(trigger => trigger.addEventListener("click", toggleModal))

function toggleModal(){
    modalContainer.classList.toggle("active");
}

//Carousel
class Carousel {
    constructor (element, options = {}){
       this.element = element
       this.options = Object.assign({}, {
           slidesToScroll: 1 ,
           slidesVisible: 1,
           loop: false,
           pagination: false,
           navigation: true,
           infinite: false
       }, options)
       let children = [].slice.call(element.children)
       this.isMobile = false
       this.currentItem = 0
       this.moveCallbacks = []
       this.offset = 0

       //Modification du DOM
       this.root = this.createDivWhithClass('carousel')
       this.container = this.createDivWhithClass('carousel-container')
       this.root.setAttribute('tabindex', '0')
       this.root.appendChild(this.container)
       this.element.appendChild(this.root)
       this.items = children.map((child) => {
         let item =  this.createDivWhithClass('carousel-item')
         item.appendChild(child)
         return item
        })
    if (this.options.infinite){
        this.offset = this.options.slidesVisible + this.options.slidesToScroll
        this.items = [
            ...this.items.slice(this.items.length - this.offset).map(item => item.cloneNode(true)),
            ...this.items,
            ...this.items.slice(0, this.offset).map(item => item.cloneNode(true)),
        ]
        this.goToItem(this.offset, false)
    }
    this.items.forEach(item => this.container.appendChild(item))
    this.setStyle()
    if(this.options.navigation){
        this.createNavigation()
    }
    if(this.options.pagination){
        this.createPagination()
    }

    //Evenements
    this.moveCallbacks.forEach(cb => cb(this.currentItem))
    this.onWindowResize()
    window.addEventListener('resize', this.onWindowResize.bind(this))
    this.root.addEventListener('keyup', e =>{
        if(e.key === 'ArrowRight' || e.key === 'Right'){
            this.next()
        } else if (e.key === 'ArrowLeft' || e.key === 'Left'){
            this.prev()
        }
    })
    if(this.options.infinite) {
        this.container.addEventListener('transitionend', this.resetInfinite.bind(this))
    }
    } 
    
    setStyle(){
        let ratio = this.items.length / this.slidesVisible
        this.container.style.width = (ratio * 100) + '%'
        this.items.forEach(item => item.style.width = ((100 / this.slidesVisible) / ratio) + '%')
    }

    createNavigation(){
        let nextButton = this.createDivWhithClass('carousel-next')
        let prevButton = this.createDivWhithClass('carousel-prev')
        this.root.appendChild(nextButton)
        this.root.appendChild(prevButton)
        nextButton.addEventListener('click', this.next.bind(this))
        prevButton.addEventListener('click', this.prev.bind(this))
        if(this.options.loop === true){
            return
        }
        this.onMove(index =>{
            if(index === 0){
                prevButton.classList.add('carousel-prev--hidden')
            } else{
                prevButton.classList.remove('carousel-prev--hidden')
            }
            if (this.items[this.currentItem + this.slidesVisible] === undefined){
                nextButton.classList.add('carousel-next--hidden')
            } else{
                nextButton.classList.remove('carousel-next--hidden')
            }
        })
    }

    createPagination(){
     let pagination = this.createDivWhithClass('carousel-pagination')
     let buttons = []
     this.root.appendChild(pagination)
     for(let i = 0; i < (this.items.length - 2 * this.offset); i = i + this.options.slidesToScroll) {
         let button = this.createDivWhithClass('carousel-pagination-button')
         button.addEventListener('click', () => this.goToItem(i + this.offset))
             pagination.appendChild(button)
             buttons.push(button)
      }
      this.onMove(index =>{
        let count = this.items.length - 2 * this.offset
        let activeButton = buttons[Math.floor(((index - this.offset) % count) / this.options.slidesToScroll)]
        if(activeButton){
            buttons.forEach(button => button.classList.remove('carousel-pagination-button-active'))
            activeButton.classList.add('carousel-pagination-button-active')
        }
      })

    }

    next(){
        this.goToItem(this.currentItem + this.slidesToScroll)
    }

    prev(){
        this.goToItem(this.currentItem - this.slidesToScroll)
    }

    goToItem(index, animation = true){
        if(index < 0){
            if(this.options.loop){
                index = this.items.length - this.slidesVisible
            } else{
                return
            }
        } else if(index >= this.items.length || (this.items[this.currentItem + this.slidesVisible] === undefined && index > this.currentItem)){
            if(this.options.loop){
                index = 0
            } else{
                return
            }
        }
        let translateX = index * -100 / this.items.length
        if(animation === false) {
            this.container.style.transition = 'none'
        }
        this.container.style.transform = 'translate3d(' + translateX + '%, 0, 0) '
        this.container.offsetHeight
        if(animation === false) {
            this.container.style.transition = ''
        }
        this.currentItem = index
        this.moveCallbacks.forEach(cb => cb(index))
    }

    resetInfinite(){
        if(this.currentItem <= this.options.slidesToScroll) {
            this.goToItem(this.currentItem + (this.items.length - 2 * this.offset), false)
        }else if (this.currentItem >= this.items.length - this.offset) {
            this.goToItem(this.currentItem - (this.items.length - 2 * this.offset), false)
        }
    }

    onMove(cb){
        this.moveCallbacks.push(cb)
    }

    onWindowResize(){
        let mobile = window.innerWidth < 800
        if(mobile !== this.isMobile){
            this.isMobile = mobile
            this.setStyle()
            this.moveCallbacks.forEach(cb => cb(this.currentItem))
        }
    }

    createDivWhithClass (className){
        let div = document.createElement('div')
        div.setAttribute('class', className)
        return div
    }

    get slidesToScroll() {
        return this.isMobile ? 1 : this.options.slidesToScroll
    }
    get slidesVisible() {
        return this.isMobile ? 1 : this.options.slidesVisible
    }
}

let onReady = function(){
    
    new Carousel(document.querySelector('#carousel'), { 
            slidesVisible: 1 ,
            slidesToScroll: 1,
            pagination: true,
            infinite: true
    })            
}

if(document.readyState !== 'loading'){
    onReady()
}
document.addEventListener('DOMContentLoaded', onReady) 

