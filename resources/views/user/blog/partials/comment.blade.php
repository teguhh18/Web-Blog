 <!-- Comments Section -->
 <div class="mt-12" data-aos="fade-up">
     <h3 class="text-2xl font-bold mb-6">Komentar ({{ $countComment }})</h3>

     <!-- Comment Form -->
     <div class="card bg-base-200 mb-8">
         <div class="card-body">
             <h4 class="card-title text-lg mb-4">Tinggalkan Komentar</h4>
             <form class="space-y-4" action="{{ route('user.comment.store', $berita->slug) }}" method="POST">
                 @csrf
                 <div class="form-control">
                     <label class="label">
                         <span class="label-text">Komentar</span>
                     </label>
                     <textarea class="textarea textarea-bordered h-24" name="comment" placeholder="Tulis komentar Anda..." required></textarea>
                 </div>
                 <button type="submit" class="btn btn-primary">
                     <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                     </svg>
                     Kirim Komentar
                 </button>
             </form>
         </div>
     </div>

     <!-- Comments List -->
     <div class="space-y-6">

         @foreach ($dataComment as $comment)
             <div class="flex gap-4">
                 <div class="avatar">
                     <div class="w-10 h-10 rounded-full">
                         @if ($comment->user->foto)
                             <img src="{{ route('storage.show', ['path' => $comment->user->foto]) }}"
                                 alt="{{ $comment->user->name }}" />
                         @else
                             <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random"
                                 alt="{{ $comment->user->name }}" />
                         @endif
                     </div>
                 </div>
                 <div class="flex-1">
                     <div class="bg-base-200 rounded-lg p-4">
                         <div class="flex items-center justify-between mb-2">
                             <span class="font-medium">{{ $comment->user->name }}</span>
                             <span
                                 class="text-sm text-base-content/60">{{ $comment->created_at->diffForHumans() }}</span>
                         </div>
                         <p class="text-sm">
                             {{ $comment->comment }}
                         </p>
                     </div>

                 </div>
             </div>
         @endforeach
     </div>
 </div>
