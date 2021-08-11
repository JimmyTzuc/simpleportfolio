
    <div class="container pt-8 mx-auto" x-data="loadEmployees()">
      <input
        x-ref="searchField"
        x-model="search"
        x-on:click="viewPage(0)"
        x-on:keydown.window.prevent.slash=" viewPage(0), $refs.searchField.focus()"
        placeholder="Search for an project..."
        type="search"
        class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-700 font-bold rounded-lg px-4 py-3"
      />
      <div class="grid m-auto grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="item in filteredEmployees" :key="item">
          <div class="flex antialiased">
            <div class="p-3 m-3  cursor-default select-none rounded bg-gray-400 dark:bg-gray-900 shadow-lg">
              <div>
                  <img class="" :src="`${item.profile_image}`">
                  </img>
              </div>
              <div class="font-semibold text-xl mt-2 mb-2 ml-2 text-gray-900 dark:text-white"><p class="text-gray-900 leading-none" x-text="item.employee_name"></p></div>
              <div class="flex">
                <button
                  class="transform mouse-pointer bg-gray-900 text-sm text-white mx-2 py-1 px-2 font-semibold rounded hover:bg-gray-700 dark:hover:bg-gray-600 hover:scale-90   focus:bg-gray-700 dark:focus:bg-gray-600 focus:outline-none">Live</button>
                <button
                  class="transform mouse-pointer bg-gray-900 text-sm text-white px-2 font-semibold rounded hover:bg-gray-700 dark:hover:bg-gray-600  hover:scale-90 dark:focus:bg-gray-600 focus:outline-none">Code</button>
              </div>
              <div class="my-2 mx-2 mr-5">
                <p class="text-gray-600" x-text="item.employee_salary"></p>
              </div>
              <div>
                <div class="font-semibold text-l text-gray-900">Tech Stack:</div>
                <div>
                    <span class="transform transition-all duration-150 inline-block bg-blue-400 bg-opacity-75 rounded px-1 py-1 text-xs font-thin text-blue-900  hover:shadow-sm  hover:scale-105">ReactJS</span>
                  <span class="transform transition-all duration-150 inline-block bg-pink-400 bg-opacity-100 rounded px-1 py-1  text-xs font-thin text-pink-900  hover:shadow-sm  hover:scale-105">Tailwind</span>
                  <span class="transform transition-all duration-150 inline-block bg-yellow-400  bg-opacity-75 rounded px-1 py-1  text-xs font-thin text-yellow-900 hover:shadow-sm  hover:scale-105">Javascript</span>
                </div>
              </div>
            </div>
          </div>
        </template>
      </div>

      <div
        class="p-3 m-3 w-full md:w-1/2 mx-auto py-6 flex justify-between items-center"
        x-show="pageCount() > 1"
      >
        <!--First Button-->
        <button
          x-on:click="viewPage(0)"
          :disabled="pageNumber==0"
          :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber==0 }"
        >
          <svg
            class="h-8 w-8 text-indigo-600"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <polygon points="19 20 9 12 19 4 19 20"></polygon>
            <line x1="5" y1="19" x2="5" y2="5"></line>
          </svg>
        </button>

        <!--Previous Button-->
        <button
          x-on:click="prevPage"
          :disabled="pageNumber==0"
          :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber==0 }"
        >
          <svg
            class="h-8 w-8 text-indigo-600"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>

        <!-- Display page numbers -->
        <template x-for="(page,index) in pages()" :key="index">
          <button
            class="px-3 py-2 rounded"
            :class="{ 'bg-indigo-600 text-white font-bold' : index === pageNumber }"
            type="button"
            x-on:click="viewPage(index)"
          >
            <span x-text="index+1"></span>
          </button>
        </template>

        <!--Next Button-->
        <button
          x-on:click="nextPage"
          :disabled="pageNumber >= pageCount() -1"
          :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber >= pageCount() -1 }"
        >
          <svg
            class="h-8 w-8 text-indigo-600"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>

        <!--Last Button-->
        <button
          x-on:click="viewPage(Math.ceil(total/size)-1)"
          :disabled="pageNumber >= pageCount() -1"
          :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber >= pageCount() -1 }"
        >
          <svg
            class="h-8 w-8 text-indigo-600"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <polygon points="5 4 15 12 5 20 5 4"></polygon>
            <line x1="19" y1="5" x2="19" y2="19"></line>
          </svg>
        </button>
      </div>

      <div>
        <div
          class="pl-3 ml-3 pr-3 mr-3 mt-6 flex flex-wrap justify-between items-center text-sm leading-5 text-gray-700"
        >
          <div
            class="w-full sm:w-auto text-center sm:text-left"
            x-show="pageCount() > 1"
          >
            Page <span x-text="pageNumber+1"> </span> of
            <span x-text="pageCount()"></span> | Showing
            <span x-text="startResults()"></span> to
            <span x-text="endResults()"></span>
          </div>

          <div
            class="w-full sm:w-auto text-center sm:text-right"
            x-show="total > 0"
          >
            Total <span class="font-bold" x-text="total"></span> results
          </div>

          <!--Message to display when no results-->
          <div
            class=" mx-auto flex items-center font-bold text-red-500"
            x-show="total===0"
          >
            <svg
              class="h-8 w-8 text-red-500"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" />
              <circle cx="12" cy="12" r="9" />
              <line x1="9" y1="10" x2="9.01" y2="10" />
              <line x1="15" y1="10" x2="15.01" y2="10" />
              <path d="M9.5 16a10 10 0 0 1 6 -1.5" />
            </svg>

            <span class="ml-4"> No results!!</span>
          </div>
        </div>
      </div>
    </div>
    
