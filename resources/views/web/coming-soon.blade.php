@extends('layouts.web.app')
@section('content')
<div class="coming-soon vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <!-- Logo (optional) -->
                <div class="mb-4">
                     <a href="/"> <img src="{{ asset($defaultSettings->site_logo ?? null) }}"
                                        alt="{{ $defaultSettings->site_title ?? null }}" style="height: 54px;"></a>
                </div>
                
                <!-- Main heading -->
                <h1 class="display-3 fw-bold mb-4 text-primary">Coming Soon</h1>
                
                <!-- Subheading -->
                <p class="lead mb-5">We're working hard to launch something amazing. Stay tuned!</p>
                
                <!-- Countdown timer -->
                <div id="countdown" class="countdown-timer d-flex justify-content-center gap-3 mb-5">
                    <div class="countdown-item">
                        <div class="countdown-number days">00</div>
                        <div class="countdown-label">Days</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number hours">00</div>
                        <div class="countdown-label">Hours</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number minutes">00</div>
                        <div class="countdown-label">Minutes</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number seconds">00</div>
                        <div class="countdown-label">Seconds</div>
                    </div>
                </div>
                
                <!-- Subscription form -->
                <div class="subscribe-form mx-auto" style="max-width: 500px;">
                    <form class="row g-2">
                        <div class="col-12 col-md-8">
                            <input type="email" class="form-control form-control-lg" placeholder="Enter your email">
                        </div>
                        <div class="col-12 col-md-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Notify Me</button>
                        </div>
                    </form>
                </div>
                
                <!-- Social links -->
                <div class="social-links mt-5">
                    <a href="#" class="text-decoration-none mx-2"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="text-decoration-none mx-2"><i class="bi bi-twitter fs-4"></i></a>
                    <a href="#" class="text-decoration-none mx-2"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" class="text-decoration-none mx-2"><i class="bi bi-linkedin fs-4"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .coming-soon {
        background-color: #f8f9fa;
        background-image: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), 
                          url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
    }
    
    .countdown-timer {
        font-family: 'Arial', sans-serif;
    }
    
    .countdown-item {
        text-align: center;
        background: white;
        border-radius: 10px;
        padding: 15px 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        min-width: 100px;
    }
    
    .countdown-number {
        font-size: 2rem;
        font-weight: bold;
        color: #0d6efd;
    }
    
    .countdown-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #6c757d;
        letter-spacing: 1px;
    }
    
    .social-links a {
        color: #6c757d;
        transition: color 0.3s;
    }
    
    .social-links a:hover {
        color: #0d6efd;
    }
</style>

<script>
    // Set the date we're counting down to
    const countDownDate = new Date();
    countDownDate.setDate(countDownDate.getDate() + 30); // 30 days from now
    
    // Update the countdown every 1 second
    const x = setInterval(function() {
        // Get today's date and time
        const now = new Date().getTime();
        
        // Find the distance between now and the countdown date
        const distance = countDownDate - now;
        
        // Time calculations for days, hours, minutes and seconds
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Display the result
        document.querySelector(".days").innerHTML = days.toString().padStart(2, '0');
        document.querySelector(".hours").innerHTML = hours.toString().padStart(2, '0');
        document.querySelector(".minutes").innerHTML = minutes.toString().padStart(2, '0');
        document.querySelector(".seconds").innerHTML = seconds.toString().padStart(2, '0');
        
        // If the countdown is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "WE'RE LIVE!";
        }
    }, 1000);
</script>   
@endsection
