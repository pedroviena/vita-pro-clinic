
/**
 * VitaPro Clinic Main JavaScript
 * ==============================
 * Scripts para funcionalidades do frontend
 */

(function() {
    'use strict';

    // Aguarda o DOM estar pronto
    document.addEventListener('DOMContentLoaded', function() {
        
        // Inicializa todas as funcionalidades
        initMobileMenu();
        initSmoothScroll();
        initFormValidation();
        initLazyLoading();
        initAnimations();
        
    });

    /**
     * Menu mobile
     */
    function initMobileMenu() {
        const toggleButton = document.querySelector('.vitapro-nav-toggle');
        const navigation = document.querySelector('.wp-block-navigation');
        
        if (toggleButton && navigation) {
            toggleButton.addEventListener('click', function() {
                navigation.classList.toggle('is-open');
                toggleButton.setAttribute('aria-expanded', 
                    navigation.classList.contains('is-open') ? 'true' : 'false'
                );
            });
        }
    }

    /**
     * Scroll suave para âncoras
     */
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    /**
     * Validação básica de formulários
     */
    function initFormValidation() {
        const forms = document.querySelectorAll('.vitapro-form');
        
        forms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                if (!validateForm(form)) {
                    e.preventDefault();
                }
            });
        });
    }

    function validateForm(form) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(function(field) {
            if (!field.value.trim()) {
                showFieldError(field, 'Este campo é obrigatório');
                isValid = false;
            } else {
                hideFieldError(field);
            }
            
            // Validação específica para email
            if (field.type === 'email' && field.value.trim()) {
                if (!isValidEmail(field.value)) {
                    showFieldError(field, 'Por favor, insira um email válido');
                    isValid = false;
                }
            }
            
            // Validação específica para telefone
            if (field.type === 'tel' && field.value.trim()) {
                if (!isValidPhone(field.value)) {
                    showFieldError(field, 'Por favor, insira um telefone válido');
                    isValid = false;
                }
            }
        });
        
        return isValid;
    }

    function showFieldError(field, message) {
        hideFieldError(field); // Remove erro anterior
        
        const errorElement = document.createElement('div');
        errorElement.className = 'vitapro-field-error';
        errorElement.style.color = 'var(--wp--preset--color--error)';
        errorElement.style.fontSize = 'var(--wp--preset--font-size--small)';
        errorElement.style.marginTop = '0.25rem';
        errorElement.textContent = message;
        
        field.parentNode.appendChild(errorElement);
        field.style.borderColor = 'var(--wp--preset--color--error)';
    }

    function hideFieldError(field) {
        const existingError = field.parentNode.querySelector('.vitapro-field-error');
        if (existingError) {
            existingError.remove();
        }
        field.style.borderColor = '';
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhone(phone) {
        const phoneRegex = /^[\d\s\(\)\-\+]{8,}$/;
        return phoneRegex.test(phone);
    }

    /**
     * Lazy loading para imagens
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            observer.unobserve(img);
                        }
                    }
                });
            });

            const lazyImages = document.querySelectorAll('img[data-src]');
            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Animações de entrada
     */
    function initAnimations() {
        if ('IntersectionObserver' in window) {
            const animationObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, {
                threshold: 0.1
            });

            const animatedElements = document.querySelectorAll('[data-animate]');
            animatedElements.forEach(function(element) {
                animationObserver.observe(element);
            });
        }
    }

    /**
     * Utilitários globais
     */
    window.VitaProClinic = {
        // Função para exibir notificações
        showNotification: function(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `vitapro-notification vitapro-notification--${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 1rem 1.5rem;
                border-radius: var(--vitapro-border-radius-medium);
                color: white;
                font-weight: 500;
                z-index: var(--vitapro-z-tooltip);
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            
            // Define cor baseada no tipo
            switch(type) {
                case 'success':
                    notification.style.backgroundColor = 'var(--wp--preset--color--success)';
                    break;
                case 'error':
                    notification.style.backgroundColor = 'var(--wp--preset--color--error)';
                    break;
                case 'warning':
                    notification.style.backgroundColor = 'var(--wp--preset--color--warning)';
                    break;
                default:
                    notification.style.backgroundColor = 'var(--wp--preset--color--primary)';
            }
            
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Animação de entrada
            setTimeout(function() {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Remove após 5 segundos
            setTimeout(function() {
                notification.style.transform = 'translateX(100%)';
                setTimeout(function() {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 5000);
        },

        // Função para scroll suave até elemento
        scrollTo: function(element, offset = 0) {
            if (typeof element === 'string') {
                element = document.querySelector(element);
            }
            
            if (element) {
                const elementPosition = element.offsetTop - offset;
                window.scrollTo({
                    top: elementPosition,
                    behavior: 'smooth'
                });
            }
        }
    };

})();
