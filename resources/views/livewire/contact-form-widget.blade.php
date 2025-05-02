<div>
    <div class="form-inner">
        <div class="row clearfix">
            <!-- Name Field -->
            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" name="name" placeholder="Your Name *" wire:model="contactName" class="form-control @error('contactName') is-invalid @enderror">
                </div>
                @error('contactName')
                    <div class="text-danger mt-1 feedback-text">
                        <i class="fas fa-exclamation-circle"></i> {{$message}}
                    </div>   
                @enderror
            </div>
            
            <!-- Email Field -->
            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" name="email" placeholder="Email address *" wire:model="contactEmail" class="form-control @error('contactEmail') is-invalid @enderror">
                </div>
                @error('contactEmail')
                    <div class="text-danger mt-1 feedback-text">
                        <i class="fas fa-exclamation-circle"></i> {{$message}}
                    </div>   
                @enderror
            </div>
            
            <!-- Phone Field -->
            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <input type="text" name="phone" placeholder="Phone *" wire:model="contactPhone" class="form-control @error('contactPhone') is-invalid @enderror">
                </div>
                @error('contactPhone')
                    <div class="text-danger mt-1 feedback-text">
                        <i class="fas fa-exclamation-circle"></i> {{$message}}
                    </div>   
                @enderror
            </div>
            
            <!-- Subject Field -->
            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <div class="input-group">
                    <div class="input-icon">
                        <i class="fas fa-heading"></i>
                    </div>
                    <input type="text" name="subject" placeholder="Subject" wire:model="contactSubject" class="form-control">
                </div>
            </div>
            
            <!-- Message Field -->
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <div class="input-group textarea-group">
                    <div class="input-icon">
                        <i class="fas fa-comment"></i>
                    </div>
                    <textarea name="message" placeholder="Message *" wire:model="contactMessage" class="form-control @error('contactMessage') is-invalid @enderror" rows="5"></textarea>
                </div>
                @error('contactMessage')
                    <div class="text-danger mt-1 feedback-text">
                        <i class="fas fa-exclamation-circle"></i> {{$message}}
                    </div>   
                @enderror
            </div>
            
            <!-- Success Message Display -->
            @if(session()->has("MessageSent"))
                <div class="col-12">
                    <div class="alert alert-success success-message">
                        <i class="fas fa-check-circle mr-2"></i> {{session('MessageSent')}}
                    </div>
                </div>
            @endif
            
            <!-- Submit Button -->
            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                <button class="theme-btn btn-one" type="submit" name="submit-form" wire:click='sendMessage' wire:loading.attr="disabled">
                    <span wire:loading.remove>Send Message</span>
                    <span wire:loading>
                        <i class="fas fa-spinner fa-spin"></i> Sending...
                    </span>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Custom Styles for Contact Form -->
    <style>
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .input-group {
            position: relative;
            display: flex;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #2B3C6B;
            z-index: 10;
        }
        
        .textarea-group .input-icon {
            top: 25px;
            transform: none;
        }
        
        .form-control {
            padding-left: 40px !important;
            border-radius: 8px !important;
            border: 1px solid #e1e1e1;
            box-shadow: none;
            transition: all 0.3s ease;
            height: 55px;
        }
        
        textarea.form-control {
            height: auto;
            padding-top: 15px !important;
        }
        
        .form-control:focus {
            border-color: #2B3C6B;
            box-shadow: 0 0 0 0.2rem rgba(43, 60, 107, 0.15);
        }
        
        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: none;
        }
        
        .feedback-text {
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        .success-message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        
        .theme-btn.btn-one {
            position: relative;
            display: inline-block;
            overflow: hidden;
            font-size: 16px;
            line-height: 30px;
            font-weight: 500;
            padding: 15px 40px;
            text-align: center;
            border-radius: 30px;
            z-index: 1;
            transition: all 0.5s ease;
        }
        
        .theme-btn.btn-one:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(43, 60, 107, 0.2);
        }
        
        .theme-btn.btn-one:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>
</div>
